@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $address->label ?? 'Address' }}</h1>
            <p class="text-muted">Address Details</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.addresses.edit', $address) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('admin.addresses.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Address Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Customer</p>
                            <p class="h6">{{ $address->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Email</p>
                            <p class="h6">{{ $address->user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Label</p>
                            <p class="h6">{{ $address->label ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Default Address</p>
                            <p>
                                @if($address->is_default)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-1">Street Address</p>
                        <p class="h6">{{ $address->address }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">City</p>
                            <p class="h6">{{ $address->city }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Phone</p>
                            <p class="h6">{{ $address->phone }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Created</p>
                            <p class="h6">{{ $address->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="h6">{{ $address->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
