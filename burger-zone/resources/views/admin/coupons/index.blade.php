@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Coupons</h1>
            <p class="text-muted">Manage discount coupons</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add Coupon
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Min Order</th>
                        <th>Usage</th>
                        <th>Status</th>
                        <th>Expires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->id }}</td>
                            <td><code>{{ $coupon->code }}</code></td>
                            <td>
                                @if($coupon->type === 'percentage')
                                    <span class="badge bg-info">{{ $coupon->value }}%</span>
                                @else
                                    <span class="badge bg-info">${{ $coupon->value }}</span>
                                @endif
                            </td>
                            <td>${{ number_format($coupon->min_order, 2) }}</td>
                            <td>
                                @if($coupon->max_uses)
                                    {{ $coupon->used_count }}/{{ $coupon->max_uses }}
                                @else
                                    {{ $coupon->used_count }}/∞
                                @endif
                            </td>
                            <td>
                                @if($coupon->is_active && (!$coupon->expires_at || $coupon->expires_at->isFuture()))
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->expires_at)
                                    {{ $coupon->expires_at->format('M d, Y') }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.coupons.show', $coupon) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">No coupons found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $coupons->links() }}
    </div>
</div>
@endsection
