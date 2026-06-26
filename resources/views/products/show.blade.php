<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  
@include('layouts.navbar')

<div class="product-details">
  <div class='produit-image'>
    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" >
  </div>
  <div class='produit-info'>
    <h1>{{ $product->name }}</h1>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Price:</strong> {{ $product->price }} MAD</p>

    <form class="add-to-cart-form" action="{{ route('cart.store', $product->id) }}" method="POST" data-product-id="{{ $product->id }}">
        @csrf
        <input type="hidden" name="name" value="{{ $product->name }}">
        <input type="hidden" name="price" value="{{ $product->price }}">
        <input type="hidden" name="image" value="{{ $product->image }}">

        <label>{{ __('messages.quantity') }} :</label>
        <div class="quantity-selector">
          <button type="button" class="qty-btn decrease">−</button>
          <span class="quantity-value">1</span>
          <input type="hidden" name="quantity" class="quantity" value="1">
          <button type="button" class="qty-btn increase">+</button>
        </div>
        <button type="submit" style="padding:5px 10px; border:none; border-radius:3px;"><i class="fa-solid fa-cart-shopping"></i> {{ __('messages.add_to_cart') }}</button>
    </form>
   

  </div> 
</div>
<div class='produit-more-info'>
   <p><strong>{{ __('messages.description') }} :</strong> {{ $product->description }}</p>
</div>



<div class='autres-produit-meme-category'>

  <h2>{{ __('messages.other_products') }}</h2>
  <div class="produit-categorie-container">
    @forelse($relatedProducts as $related)
      <div class='produit-category-card'>
        <a href="{{ route('products.show', $related->id) }}" style="text-decoration:none; color:inherit;">
          <img src="{{ asset('images/' . $related->image) }}" alt="{{ $related->name }}">
          <h1>{{ $related->name }}</h1>
          <h3>{{ $related->price }} MAD</h3>
        </a>
      </div>
    @empty
      <p>{{ __('messages.no_other_products') }} .</p>
    @endforelse
  </div>
</div>

@include('layouts.footer')
  


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>
</html>




















