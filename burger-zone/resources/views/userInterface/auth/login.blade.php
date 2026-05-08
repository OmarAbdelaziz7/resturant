@extends('Layouts.navbar')

@section('content')
<section class="layout_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm animated-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2>Login to Burger Zone</h2>
                            <p class="text-muted">Access your orders, track delivery, and checkout faster.</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('user.login') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="email">Email address</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-warning btn-block rounded-pill btn-animated">Login</button>
                        </form>

                        <div class="text-center">
                            <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
