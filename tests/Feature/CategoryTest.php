<?php

use App\Models\Category;
use App\Models\User;

test('admin can create update and delete categories from the category page', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('categories.index'))
        ->assertOk()
        ->assertSee('Tambah Kategori');

    $this->post(route('categories.store'), [
        'name' => 'Tenda',
        'description' => 'Peralatan berkemah',
    ])->assertRedirect(route('categories.index'));

    $category = Category::where('name', 'Tenda')->firstOrFail();

    $this->put(route('categories.update', $category), [
        'name' => 'Tenda Camping',
        'description' => 'Tenda untuk kegiatan berkemah',
    ])->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Tenda Camping',
        'description' => 'Tenda untuk kegiatan berkemah',
    ]);

    $this->delete(route('categories.destroy', $category))
        ->assertRedirect(route('categories.index'));

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});

test('category create validation requires a name and description', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post(route('categories.store'), [])
        ->assertSessionHasErrors(['name', 'description']);

    $this->assertDatabaseCount('categories', 0);
});
