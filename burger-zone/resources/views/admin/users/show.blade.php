@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $user->name }}</h1>
            <p class="text-muted">User Account Details</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted mb-1">Name</p>
                        <p class="h6">{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-1">Email</p>
                        <p class="h6">{{ $user->email }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-1">Role</p>
                        <p>
                            @if($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-info">User</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-1">Theme Preference</p>
                        <p class="h6">{{ ucfirst($user->theme) }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Joined</p>
                            <p class="h6">{{ $user->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Last Updated</p>
                            <p class="h6">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
