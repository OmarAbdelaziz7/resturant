@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Order Items</h1>
            <p class="text-muted">All order line items</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order #</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orderItems as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $item->order) }}" class="text-decoration-none">
                                    #{{ $item->order->id }}
                                </a>
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td><strong>${{ number_format($item->subtotal, 2) }}</strong></td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orderitems.show', $item) }}" class="btn text-light btn-sm btn-info">
                                    <i class="bi bi-eye">Show</i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No order items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $orderItems->links() }}
    </div>
</div>
@endsection
