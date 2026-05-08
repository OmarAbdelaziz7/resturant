@extends('Layouts.navbar')

@section('content')
<section class="food_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center text-center mb-5">
            <h2>Your Cart</h2>
            <p>Review your items and continue to checkout.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(empty($cart))
            <div class="text-center py-5 animated-card">
                <h4>Your cart is empty.</h4>
                <a href="{{ route('menu') }}" class="btn btn-warning rounded-pill px-4 py-2 text-white btn-animated">Browse Menu</a>
            </div>
        @else
            <div class="table-responsive mb-4 animated-card">
                <form method="POST" action="{{ route('cart.update') }}">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/100x80?text=Food' }}" alt="{{ $item['name'] }}" class="mr-3 rounded" style="width:100px; height:80px; object-fit:cover;" />
                                            <div>
                                                <h6>{{ $item['name'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td style="max-width:140px;">
                                        <input type="number" name="quantity[{{ $item['id'] }}]" value="{{ $item['quantity'] }}" min="1" class="form-control" />
                                    </td>
                                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}" />
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 btn-animated">Update Cart</button>
                </form>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Details</h5>
                            <p>{{ $storeSettings->store_name ?? 'Burger Zone' }}</p>
                            <p><strong>Address:</strong> {{ $storeSettings->store_location ?: 'Enter your address during checkout' }}</p>
                            <p><strong>Phone:</strong> {{ $storeSettings->store_phone ?: 'Not available' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
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
                            <a href="{{ route('checkout.index') }}" class="btn btn-warning rounded-pill px-4 py-2 text-white">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
