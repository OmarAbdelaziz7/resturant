@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Order Item #{{ $orderItem->id }}</h1>
            <p class="text-muted">Order line item details</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.orderitems.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Item Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Order</p>
                            <p class="h6">
                                <a href="{{ route('admin.orders.show', $orderItem->order) }}" class="text-decoration-none">
                                    Order #{{ $orderItem->order->id }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Customer</p>
                            <p class="h6">{{ $orderItem->order->user->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Product</p>
                            <p class="h6">
                                <a href="{{ route('admin.products.show', $orderItem->product) }}" class="text-decoration-none">
                                    {{ $orderItem->product->name }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Category</p>
                            <p class="h6">{{ $orderItem->product->category->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <p class="text-muted mb-1">Quantity</p>
                            <p class="h6">{{ $orderItem->quantity }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-1">Unit Price</p>
                            <p class="h6">${{ number_format($orderItem->unit_price, 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-1">Subtotal</p>
                            <p class="h6"><strong>${{ number_format($orderItem->subtotal, 2) }}</strong></p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Created</p>
                            <p class="h6">{{ $orderItem->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="h6">{{ $orderItem->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
