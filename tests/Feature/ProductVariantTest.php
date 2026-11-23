<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;

test('admin can view product variants', function () {
    $category = Category::create([
        'name' => 'Tenda',
        'description' => 'Peralatan berkemah',
    ]);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Tenda Camping',
        'image' => 'products/tenda.jpg',
        'description' => 'Tenda untuk 2 orang',
        'price_per_day' => 100000,
        'stock' => 5,
        'condition' => 'baik',
    ]);
    ProductVariant::create([
        'product_id' => $product->id,
        'variant_name' => 'Size M',
        'sku' => 'VAR-0001',
        'stock' => 5,
        'price_per_day' => 100000,
    ]);
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('variants.index', $product));

    $response
        ->assertOk()
        ->assertSee('Size M');
});
