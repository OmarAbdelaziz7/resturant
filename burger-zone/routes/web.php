<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::resource('categories', 'CategoryController');
Route::resource('products', 'ProductController');
Route::resource('orders', 'OrderController');
Route::resource('coupons', 'CouponController');
Route::resource('orderitems', 'OrderItemController');
Route::resource('addresses', 'AddressController');