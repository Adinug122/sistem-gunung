<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/produk', [LandingController::class, 'produk'])->name('produk');
Route::get('/produk/{name}', [ProductDetailController::class, 'show'])->name('produk.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'store'])->name('keranjang.tambah');
    Route::post('/keranjang/hapus/{product}', [CartController::class, 'destroy'])->name('keranjang.hapus');
    Route::post('/keranjang/hapus-semua', [CartController::class, 'clear'])->name('keranjang.clear');
});
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return view('dashboard');
    }

    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::resource('rentals', RentalController::class);
    Route::post('rentals/{rental}/confirm-pickup', [RentalController::class, 'confirmPickup'])->name('rentals.confirm-pickup');
    Route::post('rentals/{rental}/confirm-return', [RentalController::class, 'confirmReturn'])->name('rentals.confirm-return');
    Route::resource('payments', PaymentsController::class);
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
});

Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
