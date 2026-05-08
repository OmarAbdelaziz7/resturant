@extends('Layouts.navbar')

@section('content')

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center text-center mb-5">
        <h2>Our Menu</h2>
        <p>Choose your favorite meal and add it to your cart.</p>
      </div>

      <ul class="filters_menu d-flex justify-content-center mb-5 list-unstyled flex-wrap">
        <li class="active mx-3 mb-2" style="cursor: pointer;" data-filter="*">All</li>
        @isset($categories)
            @foreach($categories as $category)
                <li class="mx-3 mb-2" style="cursor: pointer;" data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
            @endforeach
        @endisset
      </ul>

      <div class="filters-content">
        <div class="row grid">
          @isset($products)
              @forelse($products as $product)
              <div class="col-sm-6 col-lg-4 all {{ Str::slug($product->category->name ?? 'uncategorized') }} mb-4">
                <div class="box shadow-sm h-100 animated-card">
                  <div>
                    <div class="img-box">
                      <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x250?text=Food' }}" alt="{{ $product->name }}" style="width:100%; height:220px; object-fit: cover;">
                    </div>
                    <div class="detail-box p-3 d-flex flex-column" style="min-height: 260px;">
                      <h5>{{ $product->name }}</h5>
                      <p>{{ Str::limit($product->description, 100) }}</p>
                      <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">${{ number_format($product->price, 2) }}</span>
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <button type="submit" class="btn btn-warning rounded-pill btn-sm text-white btn-animated">Add to Cart</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @empty
                <div class="col-12 text-center">
                    <p>No products available at the moment.</p>
                </div>
              @endforelse
          @endisset
        </div>
      </div>
    </div>
  </section>

@section('scripts')
<script>
  $(function() {
    const $filters = $('.filters_menu li');
    const $items = $('.filters-content .grid > .col-sm-6');

    $filters.on('click', function() {
      const filter = $(this).data('filter');

      $filters.removeClass('active');
      $(this).addClass('active');

      if (filter === '*') {
        $items.filter(':hidden').fadeIn(300);
        $items.filter(':visible').css({ opacity: 1 });
      } else {
        $items.filter(':visible').not(filter).fadeOut(250);
        $items.filter(filter).fadeIn(300);
      }
    });
  });
</script>
@endsection

@endsection