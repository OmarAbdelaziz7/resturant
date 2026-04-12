@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Edit Order #{{ $order->id }}</h1>
            <p class="text-muted">Update order status and payment information</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Please fix the errors below.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Order Status & Payment</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label">Order Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                @foreach($statusOptions as $status)
                                    <option value="{{ $status }}" {{ old('status', $order->status) === $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method *</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method }}" {{ old('payment_method', $order->payment_method) === $method ? 'selected' : '' }}>
                                        {{ ucfirst($method) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_status" class="form-label">Payment Status *</label>
                            <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                                @foreach($paymentStatuses as $pStatus)
                                    <option value="{{ $pStatus }}" {{ old('payment_status', $order->payment_status) === $pStatus ? 'selected' : '' }}>
                                        {{ ucfirst($pStatus) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="4">{{ old('notes', $order->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Order
                            </button>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Subtotal</small>
                        <p>${{ number_format($order->subtotal, 2) }}</p>
                    </div>
                    @if($order->discount > 0)
                        <div class="mb-2">
                            <small class="text-muted">Discount</small>
                            <p>-${{ number_format($order->discount, 2) }}</p>
                        </div>
                    @endif
                    @if($order->delivery_fee > 0)
                        <div class="mb-2">
                            <small class="text-muted">Delivery Fee</small>
                            <p>${{ number_format($order->delivery_fee, 2) }}</p>
                        </div>
                    @endif
                    <hr>
                    <div>
                        <small class="text-muted">Total</small>
                        <h5>${{ number_format($order->total, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
