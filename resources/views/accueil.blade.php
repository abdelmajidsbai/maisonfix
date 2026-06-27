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

<div class="slider-wrapper">
  
  <div class="main-image">
    <img id="image0" src="{{asset('images/camera3.jpg')}}" class="slider-image" style="opacity:1;">
    <img id="image1" src="{{asset('images/camera1.jpg')}}" class="slider-image" style="opacity:0;">
    <img id="image2" src="{{asset('images/serve.png')}}" class="slider-image" style="opacity:0;">
    
    <div class="hero-text">
      <h1 id="hero-title">{{ __('messages.hero_title') }}</h1>
      <p id="hero-subtitle">{{ __('messages.hero_subtitle') }}</p>
    </div>

    
    <div class="thumbnail-container">
      <img onclick="changeImage(0)" src="{{asset('images/camera3.jpg')}}" class="thumb active">
      <img onclick="changeImage(1)" src="{{asset('images/camera1.jpg')}}" class="thumb">
      <img onclick="changeImage(2)" src="{{asset('images/renovation_complete.png')}}" class="thumb">
    </div>

  </div>

</div>
  
<div class="categories-section">
  <div class="categories-header">
    <h2>{{ __('messages.categories') }}</h2>
    <div class="nav-buttons">
      <button class="cat-btn" id="prevCat">←</button>
      <button class="cat-btn" id="nextCat">→</button>
    </div>
  </div>

  <div class="categories-wrapper">
    <div class="categories-container" id="categoriesContainer">
      @foreach($categories as $cat)
      <div class="category-card">
         <a href="{{ route('products.index', ['category' => $cat->id]) }}">
          <img src="{{ asset('images/' . $cat->image) }}" alt="{{ $cat->name }}">
        </a> 
      </div>
      @endforeach
    </div>
  </div>
</div>


<div class='offres-section'>
  <div class='offres-container'>
    @foreach($offres as $offre)
      <div class='div-offre 
          @if($loop->first) big-offre 
          @elseif($loop->iteration == 2) small-offre-1 
          @elseif($loop->iteration == 3) small-offre-2 
          @elseif($loop->iteration == 4) wide-offre 
          @endif'
          style="background-image: url('{{ asset('images/'.$offre->image) }}');" >
        <div class="offre-overlay">
          @if($offre->descount)
            <span class="discount">{{$offre->descount}} OFF</span>
          @endif
          <h3>{{$offre->title}}</h3>
          <p>{{$offre->description}}</p>
          <a href="
            @if($loop->first || $loop->last)
              {{ route('services.index') }}
            @elseif($loop->iteration == 2 || $loop->iteration == 3)
              {{ route('products.index') }}
            @endif
          ">{{ __('messages.discover') }}</a>
        </div>
      </div>
    @endforeach
  </div>
</div>


<div class='products-section'>
  <h2>{{ __('messages.products') }}</h2>
  <div class='products-container'>
    @foreach($products as $product)
      <div class='product-card'>
        @if($product->image)
        <a href="{{ route('products.show', $product->id) }}">
          <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        </a>
        @endif
        <h3>{{$product->name}}</h3>
        <p>{{$product->price}} MAD</p>
        <div class='chek-product'>
          
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
  </div>
  <div class='view-all'>
    <a href="{{route('products.index')}}">{{ __('messages.view_all_products') }}</a>
  </div>
</div>


<div class='services-section'>
  <h2>{{ __('messages.services') }}</h2>
  <div class='services-container-h'>
    @foreach($services as $service)
      <div class='service-card-h'>
        @if($service->image)
          <img src="{{asset('images/'.$service->image)}}" alt="">
        @endif
        <div class='service-description-h'>
          <h3>{{$service->name}}</h3>
          <p>{{$service->description}}</p>
        </div>

        
        <div class="hover-window">
          <h4>{{ __('messages.service_explanation') }}</h4>

          @if($service->name === 'Installation de caméras de sécurité')
            <p>{{ __('messages.security_camera_service_1') }}</p><br>
            <p>{{ __('messages.security_camera_service_2') }}</p><br>
            <p>{{ __('messages.security_camera_service_3') }}</p>

          @elseif($service->name === 'Installation électrique domestique')
            <p>{{ __('messages.security_camera_service_4') }}</p>

          @else
            <p>Service de qualité adapté à vos besoins spécifiques.</p>
          @endif

          <a href="{{route('services.index')}}" class='hover-window-link'>{{ __('messages.view_more') }}</a>
        </div>

      </div>
    @endforeach
  </div>
  <div class='view-all'>
    <a href="{{route('services.index')}}">{{ __('messages.view_all_services') }}</a>
  </div>
</div>

















@include('layouts.footer')

<a href="https://wa.me/212709023673?text=Hello" target="_blank" 
  style="
     position: fixed;
     bottom: 20px;
     right: 20px;
     width: 60px;
     height: 60px;
     background-color: #25D366;
     color: white;
     border-radius: 50%;
     display: flex;
     align-items: center;
     justify-content: center;
     font-size: 30px;
     box-shadow: 0 2px 10px rgba(0,0,0,0.3);
     z-index: 1000;
     text-decoration: none;
   ">
    <i class="fa-brands fa-whatsapp"></i>
</a>


















<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    
    

    const sliderImages = [
    document.getElementById('image0'),
    document.getElementById('image1'),
    document.getElementById('image2')
  ];

const thumbs = document.querySelectorAll('.thumb');
let currentIndex = 0;
let slideInterval;

function changeImage(index){
  currentIndex = index;
  
  // Update image opacity
  sliderImages.forEach((img,i)=>{
    img.style.opacity = i === currentIndex ? '1' : '0';
  });

  // Update thumbnail active state
  thumbs.forEach((thumb,i)=>{
    thumb.classList.toggle('active', i===currentIndex);
  });

  // Update hero text
  const heroTitle = document.getElementById('hero-title');
  const heroSubtitle = document.getElementById('hero-subtitle');
  if(heroTitle && heroSubtitle && heroTexts[currentIndex]){
    heroTitle.textContent = heroTexts[currentIndex].title;
    heroSubtitle.textContent = heroTexts[currentIndex].subtitle;
  }

  resetInterval();
}

function startSlide(){
  slideInterval = setInterval(()=>{
    currentIndex++;
    if(currentIndex >= sliderImages.length) currentIndex = 0;
    changeImage(currentIndex);
  },3000);
}

function resetInterval(){
  clearInterval(slideInterval);
  startSlide();
}

startSlide();







 const container = document.getElementById('categoriesContainer');
  const prev = document.getElementById('prevCat');
  const next = document.getElementById('nextCat');

  function getCardsPerView() {
    const width = window.innerWidth;
    if (width <= 768) return 3;  // phone
    if (width <= 1024) return 4; // tablet
    return 7;                    // desktop
  }

  function getScrollAmount() {
    const card = container.querySelector('.category-card');
    if (!card) return 0;
    const style = window.getComputedStyle(card);
    const gap = parseInt(style.marginRight) || 20; // get real gap
    const cardWidth = card.offsetWidth + gap;
    return cardWidth * getCardsPerView();
  }

  next.addEventListener('click', () => {
    container.scrollBy({
      left: getScrollAmount(),
      behavior: 'smooth'
    });
  });

  prev.addEventListener('click', () => {
    container.scrollBy({
      left: -getScrollAmount(),
      behavior: 'smooth'
    });
  });


























  const heroTexts = [
  {
    title: "{{ __('messages.heroTitle1') }}",
    subtitle: "{{ __('messages.heroParag1') }}"
  },
  {
    title: "{{ __('messages.heroTitle2') }}",
    subtitle: "{{ __('messages.heroParag2') }}"
  },
  {
    title: "{{ __('messages.heroTitle3') }}",
    subtitle: "{{ __('messages.heroParag3') }}"
  }
];
















































  </script>
</body>
</html>