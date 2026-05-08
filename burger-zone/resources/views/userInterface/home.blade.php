@extends('Layouts.navbar')

@section('content')
<section class="layout_padding">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="heading_container">
                    <h1>Fresh burgers, fast delivery</h1>
                    <p class="mt-4">Burger Zone brings handcrafted burgers, crispy fries, and flavorful sides directly to your table. Browse our menu and order online with ease.</p>
                    <div class="mt-4">
                        <a href="{{ route('menu') }}" class="btn btn-warning rounded-pill px-4 py-2 text-white btn-animated">View Menu</a>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 ml-2 btn-animated">My Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.pexels.com/photos/1639563/pexels-photo-1639563.jpeg?auto=compress&cs=tinysrgb&w=900" alt="Burger" class="img-fluid rounded shadow-sm" style="max-height: 500px; object-fit: cover;" />
            </div>
        </div>

        <div class="row text-center mb-5">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100 animated-card">
                    <div class="card-body">
                        <h5>Premium Ingredients</h5>
                        <p>Fresh locally sourced ingredients for every burger.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100 animated-card">
                    <div class="card-body">
                        <h5>Fast Delivery</h5>
                        <p>Delicious meals delivered quickly and safely.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100 animated-card">
                    <div class="card-body">
                        <h5>Online Ordering</h5>
                        <p>Easy ordering experience from the menu straight to checkout.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="heading_container heading_center text-center mb-4" id="about">
            <h2>Featured Items</h2>
            <p>Try our best-selling burgers and latest chef specials.</p>
        </div>

        <div class="row">
            @forelse($featuredProducts as $product)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm overflow-hidden h-100 animated-card">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/450x300?text=Food' }}" class="card-img-top" alt="{{ $product->name }}" style="max-height: 220px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-warning btn-sm rounded-pill text-white btn-animated">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No featured products are available yet. Visit the menu to see the full selection.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
