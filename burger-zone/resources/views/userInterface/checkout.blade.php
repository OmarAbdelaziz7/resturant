@extends('Layouts.navbar')

@section('content')
<section class="food_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center text-center mb-5">
            <h2>Checkout</h2>
            <p>Fill in your delivery details and submit your order.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Delivery Information</h5>
                        @auth
                            <form method="POST" action="{{ route('checkout.place') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="address">Delivery Address</label>
                                    <input id="address" name="address" type="text" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" placeholder="Street, building, apartment" required>
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="01012345678" required>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="payment_method">Payment Method</label>
                                    <select id="payment_method" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                        <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash on delivery</option>
                                        <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>Card payment</option>
                                    </select>
                                    @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="coupon_code">Coupon Code</label>
                                    <input id="coupon_code" name="coupon_code" type="text" value="{{ old('coupon_code', $coupon->code ?? '') }}" class="form-control @error('coupon_code') is-invalid @enderror" placeholder="Enter coupon code">
                                    @error('coupon_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="notes">Order Notes</label>
                                    <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="4" placeholder="Any delivery instructions or preferences">{{ old('notes') }}</textarea>
                                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <button type="submit" class="btn btn-warning rounded-pill px-4 py-2 text-white btn-animated">Place Order</button>
                            </form>
                        @else
                            <div class="text-center py-5">
                                <h4 class="mb-3">Please log in to place your order</h4>
                                <p class="text-muted">Your cart is saved while you sign in or register.</p>
                                <a href="{{ route('login') }}" class="btn btn-warning rounded-pill btn-animated mb-2">Login</a>
                                <br>
                                <a href="{{ route('register') }}" class="btn btn-outline-light rounded-pill btn-animated">Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4 animated-card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                    <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Subtotal
                                <span>${{ number_format($summary['subtotal'], 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Discount
                                <span>${{ number_format($summary['discount'], 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Delivery Fee
                                <span>${{ number_format($summary['delivery_fee'], 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                Total
                                <span>${{ number_format($summary['total'], 2) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Need Help?</h5>
                        <p class="mb-1"><strong>Phone:</strong> {{ $storeSettings->store_phone ?: '01000000000' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $storeSettings->store_email ?: 'info@burgerzone.com' }}</p>
                        <p>{{ $storeSettings->store_description ?: 'Fast delivery and fresh burgers prepared just for you.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
