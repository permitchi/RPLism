<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Transaction;


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

// Route::get('/shop', function () {
//     return view('homepage.shop');
// })->middleware('auth')->name('shop');

Route::get('/shop', [HomeController::class, 'shop'])
    ->middleware('auth')->name('shop');

Route::get('/about', function () {
    return view('homepage.about');
})->middleware('auth')->name('about');

Route::get('/contact', function () {
    return view('homepage.contactus');
})->middleware('auth')->name('contact');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart');

// Cart operations
Route::post('/cart/add', [CartController::class, 'addToCart'])->middleware('auth')->name('cart.add');
Route::put('/cart/update', [CartController::class, 'updateQuantity'])->middleware('auth')->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'removeFromCart'])->middleware('auth')->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->middleware('auth')->name('cart.clear');

Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout');
// Route::post('/checkout/process', function () {
//     // Log a transaction for the current user with status 'pending'
//     if (Auth::check()) {
//         Transaction::create([
//             'user_id' => Auth::id(),
//             'status' => 'pending',
//         ]);
//     }
//     return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
// })->middleware('auth')->name('checkout.process');

Route::post('/checkout/process', [CheckoutController::class, 'process'])->middleware('auth')->name('checkout.process');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->middleware('auth')->name('checkout.success');

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');

Route::put('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update.main');

Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->middleware('auth')->name('wishlist');



// Admin Orders Page
use App\Http\Controllers\OrderAdminController;
Route::get('/adminorders', [OrderAdminController::class, 'index'])->middleware('auth')->name('adminorders');
Route::put('/adminorders/{id}/status', [OrderAdminController::class, 'updateStatus'])->middleware('auth')->name('orders.updateStatus');

// User Order History Page
Route::get('/transaction', function () {
    $user = Auth::user();
    $orders = \App\Models\Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    return view('pages.orderhistory', compact('orders'));
})->middleware('auth')->name('orderhistory');

Route::get('/addproduct', function () {
    return view('pages.addproduct');
})->middleware('auth')->name('addproduct');

Route::post('/products', [ProductController::class, 'store'])
->middleware('auth')->name('products.store');

Route::get('/myproducts', [ProductController::class, 'myProducts'])
    ->middleware('auth')->name('products.myproducts');

Route::get('/editproduct/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('pages.editproductform', compact('product'));
})->middleware('auth')->name('editproduct');

Route::put('/products/{id}', [ProductController::class, 'update'])
->middleware('auth')->name('products.update');

Route::get('/search', [HomeController::class, 'search'])
->middleware('auth')->name('products.search');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->middleware('auth')->name('products.show');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])
->middleware('auth')->name('products.destroy');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

