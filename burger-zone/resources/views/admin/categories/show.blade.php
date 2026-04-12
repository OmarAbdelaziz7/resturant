@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $category->name }}</h1>
            <p class="text-muted">Category Details</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    @if($category->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="max-height: 200px; border-radius: 5px;">
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Name</p>
                            <p class="h6">{{ $category->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Slug</p>
                            <p class="h6"><code>{{ $category->slug }}</code></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Status</p>
                            <p>
                                @if($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Sort Order</p>
                            <p class="h6">{{ $category->sort_order }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Created</p>
                            <p class="h6">{{ $category->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="h6">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="text-muted mb-1">Products in Category</p>
                            <p class="h6">{{ $category->products->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
