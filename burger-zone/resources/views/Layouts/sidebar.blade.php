<!-- Main Layout with Sidebar -->
@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>burger-zone</title>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; min-height: 100vh;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <span class="fs-4">Burger Zone</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active" aria-current="page">
                    <i class="bi bi-house-door me-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="nav-link link-dark">
                    <i class="bi bi-grid me-2"></i>
                    Categories
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}" class="nav-link link-dark">
                    <i class="bi bi-box-seam me-2"></i>
                    Products
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}" class="nav-link link-dark">
                    <i class="bi bi-receipt me-2"></i>
                    Orders
                </a>
            </li>
            <li>
                <a href="{{ route('admin.coupons.index') }}" class="nav-link link-dark">
                    <i class="bi bi-tag me-2"></i>
                    Coupons
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="nav-link link-dark">
                    <i class="bi bi-people me-2"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.addresses.index') }}" class="nav-link link-dark">
                    <i class="bi bi-geo-alt me-2"></i>
                    Addresses
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropdown-item" style="background: none; border: none; cursor: pointer;">
                            Sign out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-grow-1 p-3">
        @yield('content')
    </div>
</div>
</body>