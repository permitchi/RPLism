<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('loginregis/login');
})->name('home');

Route::get('/homepage', function () {
    return view('homepage/index');
})->middleware('auth')->name('homepage');

Route::get('/shop', function () {
    return view('homepage/shop');
})->middleware('auth')->name('shop');

Route::get('/about', function () {
    return view('homepage/about');
})->middleware('auth')->name('about');

Route::get('/contact', function () {
    return view('homepage/contactus');
})->middleware('auth')->name('contact');

Route::get('/cart', function () {
    return view('cart/index');
})->middleware('auth')->name('cart');

// Route::get('/cart', [CartController::class, 'index'])->name('cart');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
