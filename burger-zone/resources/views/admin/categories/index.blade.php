@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Categories</h1>
            <p class="text-muted">Manage your product categories</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.categories.create') }}" class="btn text-light btn-primary">
                <i class="bi bi-plus-circle me-2 "></i>Add Category
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
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="height: 30px; margin-right: 10px;">
                                @endif
                                {{ $category->name }}
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $category->sort_order }}</td>
                            <td><small>{{ $category->created_at->format('M d, Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm text-light btn-info">
                                    <i class="bi bi-eye">Show</i>
                                </a>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm text-light btn-warning">
                                    <i class="bi bi-pencil">Edit</i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-light btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash">Delete</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection