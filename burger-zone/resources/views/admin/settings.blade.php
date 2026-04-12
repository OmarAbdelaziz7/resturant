@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Settings</h1>
            <p class="text-muted">Manage your profile and store settings</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Please fix the following errors:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Profile & Store Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf

                        <!-- Profile Section -->
                        <div class="mb-4">
                            <h6 class="text-muted text-uppercase fw-bold mb-3">
                                <i class="bi bi-person-circle me-2"></i>Profile
                            </h6>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="theme" class="form-label">Theme</label>
                                <select 
                                    class="form-select @error('theme') is-invalid @enderror" 
                                    id="theme" 
                                    name="theme"
                                    required
                                >
                                    <option value="light" {{ old('theme', $user->theme) === 'light' ? 'selected' : '' }}>
                                        <i class="bi bi-sun me-2"></i>Light
                                    </option>
                                    <option value="dark" {{ old('theme', $user->theme) === 'dark' ? 'selected' : '' }}>
                                        <i class="bi bi-moon me-2"></i>Dark
                                    </option>
                                </select>
                                @error('theme')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <!-- Store Settings Section -->
                        <div class="mb-4">
                            <h6 class="text-muted text-uppercase fw-bold mb-3">
                                <i class="bi bi-shop me-2"></i>Store Information
                            </h6>

                            <div class="mb-3">
                                <label for="store_name" class="form-label">Store Name</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('store_name') is-invalid @enderror" 
                                    id="store_name" 
                                    name="store_name" 
                                    value="{{ old('store_name', $storeSettings->store_name) }}"
                                    required
                                >
                                @error('store_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="store_location" class="form-label">Store Location</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('store_location') is-invalid @enderror" 
                                    id="store_location" 
                                    name="store_location" 
                                    value="{{ old('store_location', $storeSettings->store_location) }}"
                                    placeholder="Enter your store address"
                                    required
                                >
                                @error('store_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="store_phone" class="form-label">Store Phone</label>
                                        <input 
                                            type="tel" 
                                            class="form-control @error('store_phone') is-invalid @enderror" 
                                            id="store_phone" 
                                            name="store_phone" 
                                            value="{{ old('store_phone', $storeSettings->store_phone) }}"
                                            placeholder="+1 (555) 123-4567"
                                            required
                                        >
                                        @error('store_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="store_email" class="form-label">Store Email</label>
                                        <input 
                                            type="email" 
                                            class="form-control @error('store_email') is-invalid @enderror" 
                                            id="store_email" 
                                            name="store_email" 
                                            value="{{ old('store_email', $storeSettings->store_email) }}"
                                            required
                                        >
                                        @error('store_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="store_description" class="form-label">Store Description</label>
                                <textarea 
                                    class="form-control @error('store_description') is-invalid @enderror" 
                                    id="store_description" 
                                    name="store_description" 
                                    rows="4"
                                    placeholder="Enter a brief description of your store"
                                >{{ old('store_description', $storeSettings->store_description) }}</textarea>
                                <small class="text-muted">Maximum 1000 characters</small>
                                @error('store_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h6 class="card-title text-info mb-3">
                        <i class="bi bi-info-circle me-2"></i>Note
                    </h6>
                    <p class="card-text small text-muted">
                        You can update your name, choose your preferred theme, and manage your store's business information here. 
                    </p>
                    <p class="card-text small text-muted">
                        Password changes are handled separately for security purposes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 500;
        color: #333;
    }

    .card-header {
        border-bottom: 2px solid #dee2e6;
    }

    .text-uppercase {
        letter-spacing: 0.5px;
    }
</style>
@endsection
