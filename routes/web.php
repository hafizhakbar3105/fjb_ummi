
<?php

use Illuminate\Support\Facades\Route;

// HALAMAN UTAMA / LANDING PAGE
Route::get('/', function () {
    return view('marketplace.index');
})->name('home');

// HALAMAN KATALOG PRODUK
Route::get('/produk', function () {
    return view('marketplace.products');
})->name('products');

// DETAIL PRODUK
Route::get('/produk/{id}', function (int $id) {
    return view('marketplace.product-detail', [
        'productId' => $id
    ]);
})->whereNumber('id')->name('product.detail');

// KERANJANG BELANJA
Route::get('/keranjang', function () {
    return view('marketplace.cart');
})->name('cart');