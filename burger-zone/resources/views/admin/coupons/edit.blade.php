@extends('Layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Edit Coupon</h1>
            <p class="text-muted">Update coupon information</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Please fix the errors below.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Coupon Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="code" class="form-label">Coupon Code *</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $coupon->code) }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type *</label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ old('type', $coupon->type) === $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="value" class="form-label">Value *</label>
                                    <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $coupon->value) }}" step="0.01" min="0.01" required>
                                    @error('value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="min_order" class="form-label">Minimum Order Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('min_order') is-invalid @enderror" id="min_order" name="min_order" value="{{ old('min_order', $coupon->min_order) }}" step="0.01" min="0">
                            </div>
                            @error('min_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="max_uses" class="form-label">Maximum Uses (leave empty for unlimited)</label>
                            <input type="number" class="form-control @error('max_uses') is-invalid @enderror" id="max_uses" name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" min="1">
                            @error('max_uses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="expires_at" class="form-label">Expiration Date</label>
                            <input type="date" class="form-control @error('expires_at') is-invalid @enderror" id="expires_at" name="expires_at" value="{{ old('expires_at', $coupon->expires_at?->format('Y-m-d')) }}">
                            @error('expires_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Coupon
                            </button>
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
