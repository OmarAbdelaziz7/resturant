@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Addresses</h1>
            <p class="text-muted">Manage customer delivery addresses</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.addresses.create') }}" class="btn text-light btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add Address
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
                        <th>Customer</th>
                        <th>Label</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Default</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($addresses as $address)
                        <tr>
                            <td>{{ $address->id }}</td>
                            <td>{{ $address->user->name }}</td>
                            <td>{{ $address->label }}</td>
                            <td>{{ Str::limit($address->address, 30) }}</td>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->phone }}</td>
                            <td>
                                @if($address->is_default)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.addresses.show', $address) }}" class="btn text-light btn-sm btn-info">
                                    <i class="bi bi-eye">Show</i>
                                </a>
                                <a href="{{ route('admin.addresses.edit', $address) }}" class="btn text-light btn-sm btn-warning">
                                    <i class="bi bi-pencil">Edit</i>
                                </a>
                                <form action="{{ route('admin.addresses.destroy', $address) }}" method="POST" style="display: inline;">
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
                            <td colspan="8" class="text-center py-4 text-muted">No addresses found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $addresses->links() }}
    </div>
</div>
@endsection
