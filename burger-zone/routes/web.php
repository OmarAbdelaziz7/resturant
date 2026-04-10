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
use App\Http\Controllers\UserController;

// Auth Routes (No middleware needed)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('auth.show-login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('auth.login');

// Home Routes
Route::get('/', function () {
    return view('home');
});

// Admin Routes (Protected by admin middleware)
Route::middleware(['admin'])->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Profile & Settings
    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
    
    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

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