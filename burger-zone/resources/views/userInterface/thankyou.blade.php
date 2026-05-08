@extends('Layouts.navbar')

@section('content')
<section class="food_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center text-center mb-5">
            <h2>Thank You!</h2>
            <p>Your order has been received and is being processed.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order #{{ $order->id }}</h5>
                        <p class="mb-2"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
                        <p class="mb-2"><strong>Delivery Address:</strong> {{ $order->address }}</p>
                        <p class="mb-2"><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p class="mb-4"><strong>Payment:</strong> {{ ucfirst($order->payment_method) }} ({{ ucfirst($order->payment_status) }})</p>

                        <div class="mb-4">
                            <h6>Order Details</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($order->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                                        <span>${{ number_format($item->subtotal, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="list-group list-group-flush mb-4">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Subtotal</span>
                                <span>${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Discount</span>
                                <span>${{ number_format($order->discount, 2) }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Delivery Fee</span>
                                <span>${{ number_format($order->delivery_fee, 2) }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                <span>Total</span>
                                <span>${{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('menu') }}" class="btn btn-warning rounded-pill px-4 py-2 text-white">Back to Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
