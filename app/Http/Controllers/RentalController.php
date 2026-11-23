<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use App\Models\RentalDetails;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('user')->latest()->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $users = User::all();

        return view('rentals.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rental_code' => 'required|string|unique:rentals',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_price' => 'required|numeric',
            'status' => 'required|in:menunggu_pembayaran,dibayar,diambil,selesai,dibatalkan,kadaluarsa',
            'jaminan_type' => 'nullable|in:ktp,sim,ktm,kartu_pelajar',
            'jaminan_status' => 'nullable|in:belum_diterima,ditahan,dikembalikan',
        ]);

        Rental::create($request->all());

        return redirect()->route('rentals.index')->with('success', 'Sewa berhasil dibuat.');
    }

    public function show(Rental $rental)
    {
        $rental->load(['user', 'rentalDetails.product', 'payment', 'rentalReturn']);

        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $users = User::all();

        return view('rentals.edit', compact('rental', 'users'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rental_code' => 'required|string|unique:rentals,rental_code,'.$rental->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_price' => 'required|numeric',
            'status' => 'required|in:menunggu_pembayaran,dibayar,diambil,selesai,dibatalkan,kadaluarsa',
            'jaminan_type' => 'nullable|in:ktp,sim,ktm,kartu_pelajar',
            'jaminan_status' => 'nullable|in:belum_diterima,ditahan,dikembalikan',
        ]);

        $rental->update($request->all());

        return redirect()->route('rentals.index')->with('success', 'Sewa berhasil diperbarui.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Sewa berhasil dihapus.');
    }

    /**
     * Menerima jaminan pelanggan dan mengonfirmasi penyerahan barang.
     *
     * Hanya boleh dilakukan ketika rental berstatus `dibayar` dan jaminan
     * masih belum diterima. Stok fisik produk akan berkurang.
     */
    public function confirmPickup(Request $request, Rental $rental)
    {
        $rental->refresh();

        if (! $rental->dapatDiterimaJaminan()) {
            return back()->with('error', 'Jaminan hanya bisa diterima jika rental sudah berstatus dibayar dan belum pernah diterima.');
        }

        $validated = $request->validate([
            'jaminan_type' => 'required|in:ktp,sim,ktm,kartu_pelajar',
        ]);

        try {
            DB::transaction(function () use ($rental, $validated) {
                $rental->refresh();
                $rental->jaminan_type = $validated['jaminan_type'];
                $rental->jaminan_status = Rental::JAMINAN_STATUS_DITAHAN;
                $rental->jaminan_received_at = now();
                $rental->status = 'diambil';
                $rental->save();

                $this->updateStok($rental, -1);
            });

            return redirect()->route('rentals.show', $rental)
                ->with('success', 'Jaminan diterima dan barang diserahkan. Status sewa menjadi diambil.');
        } catch (\Throwable $e) {
            Log::error('Gagal konfirmasi pengambilan jaminan: '.$e->getMessage());

            return back()->with('error', 'Gagal menerima jaminan. Silakan coba lagi.');
        }
    }

    /**
     * Mengembalikan jaminan dan menyelesaikan rental setelah pemeriksaan barang.
     *
     * Hanya boleh dilakukan ketika rental berstatus `diambil` dan jaminan
     * berstatus `ditahan`. Stok fisik produk akan bertambah kembali.
     */
    public function confirmReturn(Request $request, Rental $rental)
    {
        $rental->refresh();

        if (! $rental->dapatDikembalikanJaminan()) {
            return back()->with('error', 'Jaminan hanya bisa dikembalikan jika rental berstatus diambil dan jaminan masih ditahan.');
        }

        try {
            DB::transaction(function () use ($rental) {
                $rental->refresh();
                $rental->jaminan_status = Rental::JAMINAN_STATUS_DIKEMBALIKAN;
                $rental->jaminan_returned_at = now();
                $rental->status = 'selesai';
                $rental->save();

                $this->updateStok($rental, 1);
            });

            return redirect()->route('rentals.show', $rental)
                ->with('success', 'Jaminan dikembalikan dan rental selesai. Stok produk telah dikembalikan.');
        } catch (\Throwable $e) {
            Log::error('Gagal konfirmasi pengembalian jaminan: '.$e->getMessage());

            return back()->with('error', 'Gagal mengembalikan jaminan. Silakan coba lagi.');
        }
    }

    /**
     * Menyesuaikan stok produk berdasarkan detail rental.
     *
     * $direction: -1 untuk mengurangi stok (pengambilan), 1 untuk menambah stok (pengembalian).
     */
    protected function updateStok(Rental $rental, int $direction): void
    {
        $details = RentalDetails::where('rental_id', $rental->id)->get();

        foreach ($details as $detail) {
            $product = Product::find($detail->product_id);
            if (! $product) {
                throw new ModelNotFoundException('Produk tidak ditemukan untuk rental detail id '.$detail->id);
            }

            if ($direction === -1) {
                $product->decrement('stock', (int) $detail->quantity);
            } else {
                $product->increment('stock', (int) $detail->quantity);
            }
        }
    }
}
