<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $produk = Product::with('category')->where('stock', '>', 0)->latest()->take(6)->get();

        $galeri = Product::with('category')->where('stock', '>', 0)->latest()->take(9)->get()->map(function ($product) {
            return [
                'image' => $product->image ? asset('storage/'.$product->image) : null,
                'title' => $product->name,
                'category' => $product->category->name ?? 'Outdoor',
            ];
        });

        return view('welcome', compact('produk', 'galeri'));
    }

    public function produk(){
        
        $produk = Product::with('category')->where('stock', '>', 0)->latest()->paginate(12);

        return view('produk', compact('produk'));
    }
}
