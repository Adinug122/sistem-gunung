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

        foreach ($keranjang as $key => $item) {
            $parts = explode('.', $key, 2);
            $productId = (int) $parts[0];
            $variantId = isset($parts[1]) ? (int) $parts[1] : null;

            $product = Product::with('category')->find($productId);
            if (! $product) {
                continue;
            }

            $variant = null;
            if ($variantId) {
                $variant = $product->variants()->find($variantId);
            }

            $price = ($variant && $variant->price_per_day !== null)
                ? $variant->price_per_day
                : $product->price_per_day;

            $produk->push((object) array_merge($product->toArray(), [
                'qty' => $item['qty'] ?? 1,
                'variant_id' => $variantId,
                'variant_name' => $variant ? $variant->variant_name : null,
                'price_per_day' => $price,
                'image_url' => $product->image ? asset('storage/'.$product->image) : null,
                'has_image' => $product->image && Storage::disk('public')->exists($product->image),
            ]));
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
        $request->validate([
            'qty' => 'nullable|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $variantId = $request->input('variant_id');
        $delta = (int) ($request->input('qty', 1));

        $variant = null;
        if ($variantId) {
            $variant = $product->variants()->find($variantId);
            if (! $variant) {
                $message = 'Varian tidak ditemukan.';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 404);
                }

                return back()->with('error', $message);
            }
        }

        $key = $variantId ? "{$product->id}.{$variantId}" : (string) $product->id;
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$key])) {
            $keranjang[$key]['qty'] += $delta;
            if ($keranjang[$key]['qty'] <= 0) {
                unset($keranjang[$key]);
                $message = "{$product->name}".($variant ? " ({$variant->variant_name})" : '').' dihapus dari keranjang.';
            } else {
                $message = "{$product->name}".($variant ? " ({$variant->variant_name})" : '').' diperbarui di keranjang.';
            }
        } else {
            $keranjang[$key] = ['qty' => $delta, 'variant_id' => $variantId];
            $message = "{$product->name}".($variant ? " ({$variant->variant_name})" : '').' berhasil ditambahkan ke keranjang.';
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
        $variantId = $request->input('variant_id');
        $key = $variantId ? "{$product->id}.{$variantId}" : (string) $product->id;

        $keranjang = session('keranjang', []);
        $variantName = null;
        if (isset($keranjang[$key]) && $variantId) {
            $variant = $product->variants()->find($variantId);
            $variantName = $variant ? $variant->variant_name : null;
        }

        unset($keranjang[$key]);
        session(['keranjang' => $keranjang]);

        $count = collect($keranjang)->sum(fn ($item) => $item['qty'] ?? 0);
        $message = "{$product->name}".($variantName ? " ({$variantName})" : '').' dihapus dari keranjang.';

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
