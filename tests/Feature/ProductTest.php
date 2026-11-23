<?php

use App\Models\Category;
use App\Models\User;

test('admin can view products and the categories in the create form', function () {
    $category = Category::create([
        'name' => 'Tenda',
        'description' => 'Peralatan berkemah',
    ]);
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('products.index'));

    $response
        ->assertOk()
        ->assertSee('<option value="'.$category->id.'">'.$category->name.'</option>', false);
});
