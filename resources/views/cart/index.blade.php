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

    <style>
   /* === Mobile bottom fixed cart bar === */
.mobile-cart-bar {
  display: none; /* hidden on desktop */
   position: sticky;
  bottom: -80px; /* hidden below screen initially */
  left: 0;
  width: 100%;
  height: 60px; /* fixed small height */
  background: #fff;
  border-top: 1px solid #ddd;
  box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
  padding: 0 20px; /* horizontal only */
  justify-content: space-around;
  align-items: center;
  z-index: 1000;
  transition: all 0.4s ease-in-out; /* smooth slide */
  opacity: 0;
}

/* When active (visible) */
.mobile-cart-bar.active {
  bottom: 0;
  opacity: 1;
}

.mobile-cart-bar p {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  margin: 0;
  line-height: 1; /* prevent vertical stretching */
}

.mobile-cart-bar button {
  background: #0d6efd;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 8px 16px;
  font-weight: 600;
  font-size: 14px;
  line-height: 1;
}

/* Show only on mobile */
@media (max-width: 900px) {
  .mobile-cart-bar {
    display: flex;
    padding:0px;
  }

  .panier-total {
    display: none;
  }
}


    </style>
</head>
<body class="cart-page">
  @include('layouts.navbar')
  <div class="cart-wrapper">

  <div class='panier-section'>
    <div class='panier-container'>
      <h3>Votre Panier ( {{ count(session('cart') ?? []) }} )</h3>

      <div class='panier-produits'>
        @if(session('cart') && count(session('cart')) > 0)
        @foreach(session('cart') as $id => $product)
          <div class='produit-panier' data-id="{{ $id }}" data-price="{{ $product['price'] }}">
            <div class='produit-panier-image'>
              
              <img src="{{asset('images/'.$product['image'])}}" width="100" alt="">
              <div class='produit-panier-name'>
              <h4>{{$product['name']}}</h4>
            </div>
            </div>
            
            <div class='produit-panier-prix'>
              <h3 class="product-price">{{ $product['price'] * $product['quantity'] }}.00 MAD</h3>
            </div>
          </div>
          <div class='produit-option'>
            <div class='produit-suprimer'>
              <!-- // -->

              <div class='produit-suprimer'>
              <form action="{{ route('cart.remove', ['product' => $id]) }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" >
                 {{ __('messages.delete') }}
                </button>
                </form>
              </div>

            </div>
            <div class='produit-count'>
              <button class="btn-minus">-</button><span class="quantity">{{$product['quantity']}} </span><button class="btn-plus">+</button>
            </div>
          </div>

            @if(!$loop->last)
              <hr class="product-divider">
            @endif
        @endforeach

        @else
        <p>{{ __('messages.empty_cart') }} .</p>
        @endif


        <!-- @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif -->

       @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

    @if (session('order'))
        @php
            $order = session('order');
            $whatsapp = session('whatsapp');
        @endphp

        <h2>Votre commande</h2>
        <p><strong>Nom :</strong> {{ $order->customer_name }}</p>
        <p><strong>Téléphone :</strong> {{ $order->customer_phone }}</p>
        <p><strong>Adresse :</strong> {{ $order->customer_address }}</p>

        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($order->products as $product)
                    @php $subtotal = $product->pivot->price * $product->pivot->quantity; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->pivot->price, 2) }} DH</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ number_format($subtotal, 2) }} DH</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right;">Total :</th>
                    <th>{{ number_format($total, 2) }} DH</th>
                </tr>
            </tfoot>
        </table>

        {{-- WhatsApp send button --}}
        <div style="margin-top: 20px; text-align:center;">
            <a href="{{ $whatsapp }}" target="_blank" class="btn btn-success" style="background:green; color:white; padding:10px 20px; border-radius:8px; text-decoration:none;">
                📲 Envoyer cette commande sur WhatsApp
            </a>
        </div>
    @endif
@endif


      </div>
      
    </div>

    <div class='panier-total'>
      <h3>{{ __('messages.cart_summary') }}</h3>
      <div class='panier-prix-totale'>
        <p>{{ __('messages.total_price') }} :</p>
        @php
          $total = 0;
          if(session('cart')){
            foreach(session('cart') as $item){
              $total += $item['price'] * $item['quantity'];
            }
          }
        @endphp
        <p id="total-price">{{ number_format($total, 2) }} Dhs</p>
      </div>
      <div class='checkout'>
        <a href="{{ route('checkout.index') }}" >
        <button style="padding:10px 20px; margin-top:10px; background:#0d6efd; color:white; border:none; border-radius:5px;" >{{ __('messages.checkout') }}</button>
        </a>
      </div>
      
    </div>


  </div>

 </div>






<script>
document.addEventListener("DOMContentLoaded", function () {
    const totalPriceEl = document.getElementById("total-price");

    function updateTotalDisplay(total) {
        totalPriceEl.textContent = total.toFixed(2) + " Dhs";

        const mobileTotal = document.getElementById("mobile-total-price");
        if (mobileTotal) mobileTotal.textContent = total.toFixed(2) + " Dhs";
    }

    function updateCart(productId, quantity, productEl, quantityEl, btnPlus, btnMinus) {
        // Disable buttons during request
        btnPlus.disabled = true;
        btnMinus.disabled = true;

        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Update quantity & subtotal from server ONLY
                quantityEl.textContent = data.quantity;
                productEl.querySelector('.product-price').textContent = data.product_total.toFixed(2) + ' MAD';
                updateTotalDisplay(data.total);

                // Disable minus button if quantity is 1
                btnMinus.disabled = (data.quantity <= 1);
            }
        })
        .catch(err => console.error(err))
        .finally(() => {
            // Re-enable plus button after request
            btnPlus.disabled = false;
        });
    }

    // Single event delegation for all + / – buttons
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("btn-plus") || e.target.classList.contains("btn-minus")) {
            const produitOption = e.target.closest(".produit-option");
            const productEl = produitOption.previousElementSibling;
            const quantityEl = produitOption.querySelector(".quantity");
            const btnPlus = produitOption.querySelector(".btn-plus");
            const btnMinus = produitOption.querySelector(".btn-minus");

            let currentQty = parseInt(quantityEl.textContent);
            let newQty = currentQty;

            if (e.target.classList.contains("btn-plus")) newQty = currentQty + 1;
            else if (e.target.classList.contains("btn-minus") && currentQty > 1) newQty = currentQty - 1;

            const productId = productEl.dataset.id;
            updateCart(productId, newQty, productEl, quantityEl, btnPlus, btnMinus);
        }
    });
});






document.addEventListener("DOMContentLoaded", function () {
  const mobileBar = document.querySelector(".mobile-cart-bar");

  // Small delay so it slides in after page load
  if (mobileBar) {
    setTimeout(() => {
      mobileBar.classList.add("active");
    }, 300);
  }
});
</script>











<div class="mobile-cart-bar">
  <p id="mobile-total-price">Prix total : {{ number_format($total, 2) }} Dhs</p>
  <a href="{{ route('checkout.index') }}">
    <button>Commander</button>
  </a>
</div>


@include('layouts.footer')
</body>
</html>













