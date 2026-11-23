<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Rental;
use App\Models\RentalDetails;
use App\Models\User;

test('admin dapat melihat halaman detail sewa dengan informasi jaminan', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $rental = Rental::create([
        'rental_code' => 'RENT-001',
        'user_id' => $admin->id,
        'start_date' => today(),
        'end_date' => today()->addDays(3),
        'total_price' => 200000,
        'jaminan' => 'ktp',
        'status' => 'dibayar',
        'jaminan_status' => 'belum_diterima',
    ]);

    $response = $this->actingAs($admin)->get(route('rentals.show', $rental));

    $response->assertOk()
        ->assertSee('RENT-001')
        ->assertSee('Jaminan Identitas')
        ->assertSee('Belum Diterima')
        ->assertSee('Konfirmasi Pengambilan Barang');
});

test('admin bisa menerima jaminan dan mengonfirmasi pengambilan barang', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $category = Category::create(['name' => 'Tenda', 'description' => 'Peralatan berkemah']);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Tenda',
        'image' => 'produk.jpg',
        'description' => 'Peralatan berkemah',
        'price_per_day' => 100000,
        'stock' => 5,
    ]);

    $rental = Rental::create([
        'rental_code' => 'RENT-002',
        'user_id' => $admin->id,
        'start_date' => today(),
        'end_date' => today()->addDays(3),
        'total_price' => 200000,
        'jaminan' => 'ktp',
        'status' => 'dibayar',
        'jaminan_status' => 'belum_diterima',
    ]);

    RentalDetails::create([
        'rental_id' => $rental->id,
        'product_id' => $product->id,
        'quantity' => 2,
        'price_per_day' => 100000,
        'subtotal' => 200000,
    ]);

    // Validasi: jaminan_type wajib
    $this->actingAs($admin)
        ->post(route('rentals.confirm-pickup', $rental), [])
        ->assertSessionHasErrors(['jaminan_type']);

    // Konfirmasi pengambilan
    $this->actingAs($admin)
        ->post(route('rentals.confirm-pickup', $rental), ['jaminan_type' => 'ktp'])
        ->assertRedirect(route('rentals.show', $rental))
        ->assertSessionHas('success');

    $rental->refresh();
    $this->assertSame('diambil', $rental->status);
    $this->assertSame('ditahan', $rental->jaminan_status);
    $this->assertSame('ktp', $rental->jaminan_type);
    $this->assertNotNull($rental->jaminan_received_at);

    // Stok berkurang (5 - 2 = 3)
    $this->assertSame(3, $product->fresh()->stock);

    // Tidak bisa dilakukan dua kali
    $this->actingAs($admin)
        ->post(route('rentals.confirm-pickup', $rental), ['jaminan_type' => 'sim'])
        ->assertSessionHas('error');

    $rental->refresh();
    $this->assertSame('ditahan', $rental->jaminan_status);
    $this->assertSame(3, $product->fresh()->stock);

    // Pengembalian jaminan
    $this->actingAs($admin)
        ->post(route('rentals.confirm-return', $rental))
        ->assertRedirect(route('rentals.show', $rental))
        ->assertSessionHas('success');

    $rental->refresh();
    $this->assertSame('selesai', $rental->status);
    $this->assertSame('dikembalikan', $rental->jaminan_status);
    $this->assertNotNull($rental->jaminan_returned_at);

    // Stok bertambah kembali (3 + 2 = 5)
    $this->assertSame(5, $product->fresh()->stock);

    // Tidak bisa dikembalikan dua kali
    $this->actingAs($admin)
        ->post(route('rentals.confirm-return', $rental))
        ->assertSessionHas('error');

    $rental->refresh();
    $this->assertSame('selesai', $rental->status);
    $this->assertSame('dikembalikan', $rental->jaminan_status);
});

test('jaminan tidak bisa diterima jika rental belum dibayar', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $rental = Rental::create([
        'rental_code' => 'RENT-003',
        'user_id' => $admin->id,
        'start_date' => today(),
        'end_date' => today()->addDays(3),
        'total_price' => 200000,
        'jaminan' => 'ktp',
        'status' => 'menunggu_pembayaran',
        'jaminan_status' => 'belum_diterima',
    ]);

    $this->actingAs($admin)
        ->post(route('rentals.confirm-pickup', $rental), ['jaminan_type' => 'ktp'])
        ->assertSessionHas('error');

    $rental->refresh();
    $this->assertSame('belum_diterima', $rental->jaminan_status);
    $this->assertSame('menunggu_pembayaran', $rental->status);
});

test('jaminan tidak bisa dikembalikan jika belum ditahan', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $rental = Rental::create([
        'rental_code' => 'RENT-004',
        'user_id' => $admin->id,
        'start_date' => today(),
        'end_date' => today()->addDays(3),
        'total_price' => 200000,
        'jaminan' => 'ktp',
        'status' => 'diambil',
        'jaminan_status' => 'belum_diterima',
    ]);

    $this->actingAs($admin)
        ->post(route('rentals.confirm-return', $rental))
        ->assertSessionHas('error');

    $rental->refresh();
    $this->assertSame('belum_diterima', $rental->jaminan_status);
    $this->assertSame('diambil', $rental->status);
});
