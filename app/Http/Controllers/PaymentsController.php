<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payments::with('rental')->latest()->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $rentals = Rental::all();

        return view('payments.create', compact('rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount' => 'required|numeric',
            'jaminan' => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,e_wallet,qr',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        Payments::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function show(Payments $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payments $payment)
    {
        $rentals = Rental::all();

        return view('payments.edit', compact('payment', 'rentals'));
    }

    public function update(Request $request, Payments $payment)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount' => 'required|numeric',
            'jaminan' => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,e_wallet,qr',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payments $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
