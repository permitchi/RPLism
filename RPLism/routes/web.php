<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('homepage');
    }
    return view('loginregis.login');
})->name('home');

// Route::get('/homepage', function () {
//     return view('homepage.index');
// })->middleware('auth')->name('homepage');

Route::get('/homepage', [HomeController::class, 'index'])
->middleware('auth')->name('homepage');

Route::get('/shop', function () {
    return view('homepage.shop');
})->middleware('auth')->name('shop');

Route::get('/about', function () {
    return view('homepage.about');
})->middleware('auth')->name('about');

Route::get('/contact', function () {
    return view('homepage.contactus');
})->middleware('auth')->name('contact');

Route::get('/cart', function () {
    return view('cart.index');
})->middleware('auth')->name('cart');

Route::get('/checkout', function () {
    return view('checkout/index');
})->middleware('auth')->name('checkout');

Route::post('/checkout/process', function () {
    // Handle checkout processing logic here
    return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
})->middleware('auth')->name('checkout.process');

Route::get('/checkout/success', function () {
    return view('checkout/success');
})->middleware('auth')->name('checkout.success');

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');

Route::put('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Route::get('/cart', [CartController::class, 'index'])->name('cart');


Route::get('/addproduct', function () {
    return view('pages.addproduct');
})->middleware('auth')->name('addproduct');

Route::post('/products', [ProductController::class, 'store'])
->middleware('auth')->name('products.store');

Route::get('/myproducts', [ProductController::class, 'myProducts'])
    ->middleware('auth')->name('products.myproducts');

Route::get('/search', [HomeController::class, 'search'])
->middleware('auth')->name('pages.search');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->middleware('auth')->name('products.show');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

