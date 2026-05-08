<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StoreSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    protected function getCart(): array
    {
        return Session::get('cart', []);
    }

    protected function getCartSummary(array $cart, ?Coupon $coupon = null): array
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['price'];
        }

        $discount = 0;
        if ($coupon) {
            if ($coupon->type === 'percentage') {
                $discount = round($subtotal * ($coupon->value / 100), 2);
            } else {
                $discount = min($subtotal, $coupon->value);
            }
        }

        $deliveryFee = 0;
        $total = round($subtotal - $discount + $deliveryFee, 2);

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
        ];
    }

    public function home()
    {
        $storeSettings = StoreSetting::getSettings();
        $featuredProducts = Product::with('category')
            ->where('is_available', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->where('is_available', true)
                ->orderBy('sort_order')
                ->take(6)
                ->get();
        }

        return view('userInterface.home', compact('storeSettings', 'featuredProducts'));
    }

    public function menu()
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $products = Product::with('category')
            ->where('is_available', true)
            ->orderBy('sort_order')
            ->get();
        $storeSettings = StoreSetting::getSettings();
        return view('userInterface.menu', compact('categories', 'products', 'storeSettings'));
    }

    public function cart()
    {
        $cart = $this->getCart();
        $couponCode = Session::get('coupon_code');
        $coupon = null;
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if (!$coupon || !$coupon->isValid()) {
                $coupon = null;
                Session::forget('coupon_code');
            }
        }

        $summary = $this->getCartSummary($cart, $coupon);
        $storeSettings = StoreSetting::getSettings();

        return view('userInterface.cart', compact('cart', 'summary', 'coupon', 'storeSettings'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = $this->getCart();
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        Session::put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();
        foreach ($request->quantity as $productId => $quantity) {
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        Session::put('cart', $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = $this->getCart();
        unset($cart[$request->product_id]);
        Session::put('cart', $cart);

        return back()->with('success', 'Item removed from cart.');
    }

    public function checkout(Request $request)
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty. Add items before checking out.');
        }

        $coupon = null;
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if (!$coupon || !$coupon->isValid()) {
                return back()->with('error', 'The coupon code is invalid or expired.');
            }
            Session::put('coupon_code', $coupon->code);
        } elseif (Session::has('coupon_code')) {
            $coupon = Coupon::where('code', Session::get('coupon_code'))->first();
            if (!$coupon || !$coupon->isValid()) {
                $coupon = null;
                Session::forget('coupon_code');
            }
        }

        $summary = $this->getCartSummary($cart, $coupon);
        $storeSettings = StoreSetting::getSettings();

        return view('userInterface.checkout', compact('cart', 'summary', 'coupon', 'storeSettings'));
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);
        return view('userInterface.orders', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        $order->load('items.product');
        return view('userInterface.order_detail', compact('order'));
    }

    public function placeOrder(Request $request)
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:25',
            'payment_method' => 'required|in:cash,card',
            'coupon_code' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $coupon = null;
        $discount = 0;
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if (!$coupon || !$coupon->isValid()) {
                return back()->withInput()->with('error', 'The coupon code is invalid or expired.');
            }
            if ($coupon->type === 'percentage') {
                $discount = round(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)) * ($coupon->value / 100), 2);
            } else {
                $discount = min(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)), $coupon->value);
            }
        }

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to place your order.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['price'];
        }

        $deliveryFee = 0;
        $total = round($subtotal - $discount + $deliveryFee, 2);

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => $validated['payment_method'],
            'payment_status' => $validated['payment_method'] === 'card' ? 'paid' : 'pending',
            'subtotal' => $subtotal,
            'discount' => $discount,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);
        }

        if ($coupon) {
            $coupon->increment('used_count');
        }

        Session::forget(['cart', 'coupon_code']);

        return redirect()->route('checkout.thankyou', $order)->with('success', 'Your order has been placed successfully.');
    }

    public function thankYou(Order $order)
    {
        $order->load(['items.product']);
        $storeSettings = StoreSetting::getSettings();
        return view('userInterface.thankyou', compact('order', 'storeSettings'));
    }
}
