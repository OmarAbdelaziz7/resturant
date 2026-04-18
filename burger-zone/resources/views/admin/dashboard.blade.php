@extends('Layouts.sidebar')

@section('content')
<br>
    <h1>Admin Dashboard</h1>
<p class="text-muted">Manage your store easily 🚀</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text ">{{ $totalOrders }}</p>

                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">

                            <h6 class="card-text ">Pending Orders</h6>
                            <p class="card-text ">{{ $pendingOrders }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-text ">Delivered Orders</h6>
                    <p class="card-text ">{{ $DeliveredOrders }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection