<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductDetailController extends Controller
{
    public function show(string $name): View
    {
        $product = Product::with('category')
            ->where('name', $name)
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        return view('products.detail', compact('product', 'relatedProducts'));
    }
}
