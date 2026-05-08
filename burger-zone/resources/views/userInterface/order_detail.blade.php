@extends('Layouts.navbar')

@section('content')
<section class="layout_padding">
    <div class="container">
        <div class="heading_container heading_center text-center mb-4">
            <h2>Order #{{ $order->id }}</h2>
            <p>Track the latest status and review your order details.</p>
        </div>

        <div class="card shadow-sm animated-card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5>Delivery</h5>
                        <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p class="mb-0"><strong>Notes:</strong> {{ $order->notes ?: 'No special instructions' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5>Payment</h5>
                        <p class="mb-1"><strong>Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p class="mb-1"><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                        <p class="mb-0"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm animated-card mb-4">
            <div class="card-body">
                <h5 class="mb-3">Order Progress</h5>
                <div class="progress" style="height: 14px;">
                    @php
                        $steps = ['pending' => 1, 'confirmed' => 2, 'preparing' => 3, 'out_for_delivery' => 4, 'delivered' => 5];
                        $current = $steps[$order->status] ?? 1;
                        $progress = ($current - 1) * 25;
                    @endphp
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <small class="text-muted">Pending</small>
                    <small class="text-muted">Confirmed</small>
                    <small class="text-muted">Preparing</small>
                    <small class="text-muted">Out for delivery</small>
                    <small class="text-muted">Delivered</small>
                </div>
            </div>
        </div>

        <div class="card shadow-sm animated-card">
            <div class="card-body">
                <h5 class="mb-3">Items</h5>
                <ul class="list-group list-group-flush">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span>${{ number_format($item->subtotal, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('account.orders') }}" class="btn btn-outline-dark rounded-pill btn-animated">Back to My Orders</a>
        </div>
    </div>
</section>
@endsection
