<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return app(ShopController::class)->cart();
    }

    public function update(Request $request)
    {
        return app(ShopController::class)->updateCart($request);
    }

    public function remove(Request $request)
    {
        return app(ShopController::class)->removeFromCart($request);
    }
}
