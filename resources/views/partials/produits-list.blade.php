@foreach($products as $product)
  <div class='product-card'>
    @if($product->image)
      <a href="{{ route('products.show', $product->id) }}">
        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
      </a>
    @endif
    <h3>{{ $product->name }}</h3>
    <p>{{ $product->price }} MAD</p>
    <div class='chek-product'>


      <!-- Formulaire AJAX : on garde method POST pour Laravel -->
      <form class="add-to-cart-form" action="{{ route('cart.store', $product->id) }}" method="POST" data-product-id="{{ $product->id }}">
      @csrf
      <input type="hidden" name="name" value="{{ $product->name }}">
      <input type="hidden" name="price" value="{{ $product->price }}">
      <input type="hidden" name="image" value="{{ $product->image }}">
      <button type="submit" class="add-to-cart-btn fa-solid fa-cart-shopping" title="Ajouter au panier"></button>
      </form>

      <form action="{{ route('checkout.direct', $product->id) }}" method="POST">
        @csrf
        <button type="submit">{{ __('messages.buy_now') }}</button>
      </form>

    </div>
  </div>
@endforeach

@if($products->isEmpty())
  <p>{{ __('messages.no_products_found') }}</p>
@endif
