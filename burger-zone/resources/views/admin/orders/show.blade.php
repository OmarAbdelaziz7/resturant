@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Order #{{ $order->id }}</h1>
            <p class="text-muted">Order Details & Management</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Customer</p>
                            <p class="h6">{{ $order->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Email</p>
                            <p class="h6">{{ $order->user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Status</p>
                            <p>
                                <span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Payment Status</p>
                            <p>
                                @if($order->payment_status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Payment Method</p>
                            <p class="h6">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Ordered</p>
                            <p class="h6">{{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-1">Address</p>
                        <p class="h6">{{ $order->address }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-1">Phone</p>
                        <p class="h6">{{ $order->phone }}</p>
                    </div>

                    @if($order->notes)
                        <div class="mb-3">
                            <p class="text-muted mb-1">Notes</p>
                            <p>{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->unit_price, 2) }}</td>
                                    <td><strong>${{ number_format($item->subtotal, 2) }}</strong></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No items</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6 text-end">Subtotal</div>
                        <div class="col-md-6">${{ number_format($order->subtotal, 2) }}</div>
                    </div>
                    @if($order->discount > 0)
                        <div class="row mb-2">
                            <div class="col-md-6 text-end">Discount</div>
                            <div class="col-md-6">-${{ number_format($order->discount, 2) }}</div>
                        </div>
                    @endif
                    @if($order->delivery_fee > 0)
                        <div class="row mb-2">
                            <div class="col-md-6 text-end">Delivery Fee</div>
                            <div class="col-md-6">${{ number_format($order->delivery_fee, 2) }}</div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-end"><h6>Total</h6></div>
                        <div class="col-md-6"><h6>${{ number_format($order->total, 2) }}</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
