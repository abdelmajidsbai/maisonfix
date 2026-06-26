<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  @include('layouts.navbar')
  <div class='slider-produits'>
    <img id="image0" src="{{asset('images/camera3.jpg')}}" class="" >
    <h1>{{ __('messages.products') }}</h1>
  </div>

  <div class='produits-page-section'>

    <div class='produits-filter'>

      <div class="categories-bar-container">
        <button class="scroll-btn left"><i class="fa fa-chevron-left"></i></button>

        <div class="categories-bar" id="categoriesBar">
          <div class="category-item {{ request('category') == '' ? 'active' : '' }}" data-id="">All</div>
            @foreach($categories as $category)
              <div class="category-item {{ request('category') == $category->id ? 'active' : '' }}" 
              data-id="{{ $category->id }}">
              {{ $category->name }}
              </div>
            @endforeach
          </div>

        <button class="scroll-btn right"><i class="fa fa-chevron-right"></i></button>
      </div>

      
    </div>

    <div class='products-container' id="products-container">
      @include('partials.produits-list', ['products' => $products])
    </div>

  </div>
  


@include('layouts.footer')







<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>



$(document).ready(function() {

    function filterProducts(categoryId) {
        $.ajax({
            url: "{{ route('products.search') }}",
            type: "GET",
            data: { category: categoryId },
            success: function(data) {
                $('#products-container').html(data);

                // Update URL
                let newUrl = window.location.origin + window.location.pathname;
                if(categoryId) newUrl += '?category=' + encodeURIComponent(categoryId);
                window.history.replaceState(null, '', newUrl);
            }
        });
    }

    // Handle category click
    $('.category-item').on('click', function() {
        $('.category-item').removeClass('active');
        $(this).addClass('active');
        const categoryId = $(this).data('id');
        filterProducts(categoryId);
    });

    // Scroll buttons
    const bar = $('#categoriesBar')[0];
    $('.scroll-btn.left').on('click', () => bar.scrollBy({ left: -150, behavior: 'smooth' }));
    $('.scroll-btn.right').on('click', () => bar.scrollBy({ left: 150, behavior: 'smooth' }));

});





</script>


</body>
</html>