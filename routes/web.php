
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('marketplace.index');
})->name('home');
