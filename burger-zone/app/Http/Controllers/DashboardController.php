<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $DeliveredOrders = Order::where('status', 'delivered')->count();
        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalUsers', 'pendingOrders', 'DeliveredOrders'));
    }
}
