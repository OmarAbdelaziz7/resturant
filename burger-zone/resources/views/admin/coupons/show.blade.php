@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $coupon->code }}</h1>
            <p class="text-muted">Coupon Details</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Coupon Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Code</p>
                            <p class="h6"><code>{{ $coupon->code }}</code></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Discount Type</p>
                            <p class="h6">{{ ucfirst($coupon->type) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Value</p>
                            <p class="h6">
                                @if($coupon->type === 'percentage')
                                    {{ $coupon->value }}%
                                @else
                                    ${{ number_format($coupon->value, 2) }}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Minimum Order</p>
                            <p class="h6">${{ number_format($coupon->min_order, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Status</p>
                            <p>
                                @if($coupon->is_active && (!$coupon->expires_at || $coupon->expires_at->isFuture()))
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Expiration Date</p>
                            <p class="h6">
                                @if($coupon->expires_at)
                                    {{ $coupon->expires_at->format('M d, Y') }}
                                @else
                                    <span class="text-muted">No expiration</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Maximum Uses</p>
                            <p class="h6">
                                @if($coupon->max_uses)
                                    {{ $coupon->max_uses }}
                                @else
                                    <span class="text-muted">Unlimited</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Used Count</p>
                            <p class="h6">{{ $coupon->used_count }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Created</p>
                            <p class="h6">{{ $coupon->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="h6">{{ $coupon->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
