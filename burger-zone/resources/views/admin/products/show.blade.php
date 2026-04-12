@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Product Details</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Product Information</h5>
                </div>
                <div class="card-body">
                    @if($product->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 250px; border-radius: 5px;">
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Category</p>
                            <p class="h6">{{ $product->category->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Price</p>
                            <p class="h6"><strong>${{ number_format($product->price, 2) }}</strong></p>
                        </div>
                    </div>

                    @if($product->description)
                        <div class="mb-3">
                            <p class="text-muted mb-1">Description</p>
                            <p>{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Availability</p>
                            <p>
                                @if($product->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Unavailable</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Featured</p>
                            <p>
                                @if($product->is_featured)
                                    <span class="badge bg-warning text-dark">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Sort Order</p>
                            <p class="h6">{{ $product->sort_order }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Slug</p>
                            <p class="h6"><code>{{ $product->slug }}</code></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Created</p>
                            <p class="h6">{{ $product->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="h6">{{ $product->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
