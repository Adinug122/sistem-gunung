<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        $produk = collect();

        foreach ($keranjang as $id => $item) {
            $product = Product::with('category')->find($id);
            if ($product) {
                $produk->push((object) array_merge($product->toArray(), [
                    'qty' => $item['qty'] ?? 1,
                    'image_url' => $product->image ? asset('storage/'.$product->image) : null,
                    'has_image' => $product->image && Storage::disk('public')->exists($product->image),
                ]));
            }
        }

        $total = $produk->sum(fn ($item) => $item->price_per_day * $item->qty);
        $count = collect($keranjang)->sum(fn ($item) => $item['qty'] ?? 0);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'produk' => $produk,
                'total' => $total,
                'count' => $count,
            ]);
        }

        return view('keranjang', compact('produk', 'total', 'count'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate(['qty' => 'nullable|integer']);

        $delta = (int) ($request->input('qty', 1));
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$product->id])) {
            $keranjang[$product->id]['qty'] += $delta;
            if ($keranjang[$product->id]['qty'] <= 0) {
                unset($keranjang[$product->id]);
                $message = "{$product->name} dihapus dari keranjang.";
            } else {
                $message = "{$product->name} diperbarui di keranjang.";
            }
        } else {
            $keranjang[$product->id] = ['qty' => $delta];
            $message = "{$product->name} berhasil ditambahkan ke keranjang.";
        }

        session(['keranjang' => $keranjang]);

        $count = collect($keranjang)->sum(fn ($item) => $item['qty'] ?? 0);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }

    public function destroy(Product $product, Request $request)
    {
        $keranjang = session('keranjang', []);
        unset($keranjang[$product->id]);
        session(['keranjang' => $keranjang]);

        $count = collect($keranjang)->sum(fn ($item) => $item['qty'] ?? 0);
        $message = "{$product->name} dihapus dari keranjang.";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }

    public function clear(Request $request)
    {
        session(['keranjang' => []]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count' => 0,
                'message' => 'Keranjang dikosongkan.',
            ]);
        }

        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
