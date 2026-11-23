<?php

use App\Models\Category;
use App\Models\Product;

test('public product detail looks up products by name', function () {
    $category = Category::create([
        'name' => 'Tenda',
        'description' => 'Perlengkapan berkemah.',
    ]);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Tenda Gunung Merapi',
        'image' => '',
        'description' => 'Tenda ringan untuk pendakian.',
        'price_per_day' => 25000,
        'stock' => 3,
        'condition' => 'baik',
    ]);

    $response = $this->get(route('produk.detail', ['name' => $product->name]));

    $response
        ->assertOk()
        ->assertSee($product->name)
        ->assertSee('Tenda ringan untuk pendakian.')
        ->assertSee('Rp 25.000');
});

test('public product detail returns not found for an unknown product name', function () {
    $this->get(route('produk.detail', ['name' => 'Produk Tidak Ada']))
        ->assertNotFound();
});
