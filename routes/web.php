<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;



// Laravel Breeze package

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//////////////////////////////////////////////////////////////////////
// Shop Main

//Index Page Route
Route::get('/', [StoreController::class, 'index'])-> name('shop.index');
//About Page Route
Route::get('/about', [StoreController::class, 'about'])-> name('shop.about');
//Products Page Route
Route::get('/products', [StoreController::class, 'products'])-> name('shop.products');
// Contact Page Route
Route::get('/contact', [StoreController::class,'contact'])->name('shop.contact');
// Shopping Cart Page Route
Route::get('/cart', [CartController::class, 'show'])->name('shop.show');
//////////////////////////////////////////////////////////////////////
// Products

// Create Page Route
Route::get('/create', [ProductsController ::class,'dashboard'])->name('dashboard.index');
// Store Product Route
Route::post('/create', [ProductsController ::class,'store'])->name('products.store');
// Single Product Route
Route::get('/products/{product}', [ProductsController ::class,'show'])->name('products.show');
//////////////////////////////////////////////////////////////////////
// Cart

// index
Route::get('/cart/{cart}', [CartController::class, 'show'])->name('cart.show');
// Add to Cart
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
// Update Cart
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
// Remove from Cart
Route::delete('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
/////////////////////////////////////////////////////////////////////
// Order

// Store Order in DB
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
// Checkout view
Route::get('/checkout', [CheckoutController::class,'show'])->name('checkout.show');
// Checkout data store
Route::post('/checkout/store', [CheckoutController::class,'store'])->name('checkout.store');
// Confirmation 
Route::get('/confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation.show');
