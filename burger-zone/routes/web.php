<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

// Auth Routes (No middleware needed)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('auth.show-login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/logout', [AuthController::class, 'userLogout'])->middleware('auth')->name('user.logout');

// Public Shop Routes
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/menu', [ShopController::class, 'menu'])->name('menu');
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [ShopController::class, 'placeOrder'])->middleware('auth')->name('checkout.place');
Route::get('/checkout/thank-you/{order}', [ShopController::class, 'thankYou'])->name('checkout.thankyou');

Route::middleware(['user'])->group(function () {
    Route::get('/account/orders', [ShopController::class, 'orders'])->name('account.orders');
    Route::get('/account/orders/{order}', [ShopController::class, 'orderDetail'])->name('account.orders.show');
});

// Admin Routes (Protected by admin middleware)
Route::middleware(['admin'])->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Profile & Settings
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

    // Admin Resources with proper naming
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('coupons', CouponController::class);
        Route::resource('orderitems', OrderItemController::class);
        Route::resource('addresses', AddressController::class);
        Route::resource('users', UserController::class);
    });
});