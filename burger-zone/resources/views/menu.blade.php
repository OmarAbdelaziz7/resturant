@extends('Layouts.navbar')

@section('content')

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center text-center mb-5">
        <h2>
          Our Menu
        </h2>
      </div>

      <ul class="filters_menu d-flex justify-content-center mb-5 list-unstyled">
        <li class="active mx-3" style="cursor: pointer;" data-filter="*">All</li>
        @isset($categories)
            @foreach($categories as $category)
                <li class="mx-3" style="cursor: pointer;" data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
            @endforeach
        @endisset
      </ul>

      <div class="filters-content">
        <div class="row grid">
          @isset($products)
              @foreach($products as $product)
              <div class="col-sm-6 col-lg-4 all {{ Str::slug($product->category->name ?? 'uncategorized') }}">
                <div class="box">
                  <div>
                    <div class="img-box">
                      <!-- Assuming images are stored in public/storage/images or similar -->
                      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 145px; object-fit: cover;">
                    </div>
                    <div class="detail-box">
                      <h5>{{ $product->name }}</h5>
                      <p>{{ Str::limit($product->description, 120) }}</p>
                      <div class="options d-flex justify-content-between align-items-center">
                        <h6>${{ $product->price }}</h6>
                        <a href="" class="add-to-cart-btn">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
          @else
              <p class="text-center w-100">No products available at the moment.</p>
          @endisset
        </div>
      </div>
      
      <div class="btn-box mt-5 text-center">
        <a href="" class="btn btn-warning rounded-pill px-4 py-2 text-white" style="background-color: #ffbe33; border-color: #ffbe33;">
          View More
        </a>
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