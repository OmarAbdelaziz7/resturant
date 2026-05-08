@extends('Layouts.navbar')

@section('content')
<section class="layout_padding">
    <div class="container">
        <div class="heading_container heading_center text-center mb-4">
            <h2>My Orders</h2>
            <p>Track your active and past orders from one place.</p>
        </div>

        @if($orders->isEmpty())
            <div class="text-center py-5">
                <h4>No orders found yet.</h4>
                <p>Browse the menu to place your first order.</p>
                <a href="{{ route('menu') }}" class="btn btn-warning rounded-pill btn-animated">Browse Menu</a>
            </div>
        @else
            <div class="row g-4">
                @foreach($orders as $order)
                    <div class="col-md-6">
                        <div class="card shadow-sm animated-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="card-title">Order #{{ $order->id }}</h5>
                                        <p class="mb-1 text-muted">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span class="badge badge-pill badge-warning">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                                </div>
                                <p class="mb-1"><strong>Total</strong>: ${{ number_format($order->total, 2) }}</p>
                                <p class="mb-0"><strong>Items</strong>: {{ $order->items->count() }}</p>
                                <a href="{{ route('account.orders.show', $order) }}" class="btn btn-outline-dark btn-sm mt-3">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
