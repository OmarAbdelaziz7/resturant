@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Products</h1>
            <p class="text-muted">Manage your menu products</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.products.create') }}" class="btn text-light btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add Product
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
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="height: 30px; margin-right: 10px; border-radius: 3px;">
                                @endif
                                {{ $product->name }}
                            </td>
                            <td><span class="badge bg-info">{{ $product->category->name }}</span></td>
                            <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                            <td>
                                @if($product->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Unavailable</span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_featured)
                                    <span class="badge bg-warning text-dark">Featured</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td><small>{{ $product->created_at->format('M d, Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}" class="btn text-light btn-sm btn-info">
                                    <i class="bi bi-eye">Show</i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn text-light btn-sm btn-warning">
                                    <i class="bi bi-pencil">Edit</i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-light btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash">Delete</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection