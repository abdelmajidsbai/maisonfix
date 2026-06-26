
<nav class="navbar">
  <div class="navbar-content">
    <!-- TOP ROW for mobile -->
    <div class="top-row">
      <button class="menu-toggle" id="menu-toggle">☰</button>
      <div class="logo">
        <a href="/" class='desktop-logo-img-link'><img src="{{asset('images/logooo.png')}}" alt="" class="desktop-logo-img"></a>
      </div>
      

      <div  class="cart " style='gap:15px;'>
      <a href="{{ route('cart.index') }}" class="cart " >
            
        <div class="cart-icon">
          <i class="fa-solid fa-cart-shopping"></i>
          @if(session('cart') && count(session('cart')) > 0)
            <span class="cart-count" id="cart-count">
            {{ count(session('cart') ?? []) }}
            </span>
           @endif
        </div>
      </a>
      <div class="lang-dropdown">
        <button class="lang-btn">
          {{ strtoupper(app()->getLocale()) }}
         <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="lang-menu">
          <a href="{{ route('lang.switch', 'fr') }}">Français</a>
          <a href="{{ route('lang.switch', 'ar') }}">العربية</a>
        </div>
      </div>
      </div>

    </div>

    <!-- DESKTOP STRUCTURE -->
    <div class="logo desktop-logo">
      <a href="/">
        <img src="{{asset('images/logooo.png')}}" alt="" class="desktop-logo-img">
      </a>
    </div>

    <ul class="nav-links" id="nav-links">
      <li><a href="/" class="active">{{ __('messages.home') }}</a></li>
      <li><a href="/produits">{{ __('messages.products') }}</a></li>
      <li><a href="/services">{{ __('messages.services') }}</a></li>
      <li><a href="/contact">{{ __('messages.contact') }}</a></li>
      
    </ul>

    <div class="search-container">
      <form id="search-form" action="{{ route('products.index') }}" method="GET" class="search-container">
        <input type="search" name="search" placeholder="Chercher..." id="search-input"  value="{{ request('search') }}" />
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <div class="cart desktop-cart " style='gap:15px;'>
      <a href="{{ route('cart.index') }}" class="cart desktop-cart ">
        <div class="cart-icon">
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="cart-count" id="cart-count">{{ count(session('cart') ?? []) }}</span>
        </div>
        <span class="cart-text">{{ __('messages.cart') }}</span>
      </a>

      <div class="lang-dropdown">
        <button class="lang-btn">
          {{ strtoupper(app()->getLocale()) }}
         <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="lang-menu">
          <a href="{{ route('lang.switch', 'fr') }}">Français</a>
          <a href="{{ route('lang.switch', 'ar') }}">العربية</a>
        </div>
      </div>
      

    </div>

  </div>

  <div class="menu-overlay" id="menu-overlay"></div>
</nav>



<script>
 const toggleBtn = document.getElementById('menu-toggle');
const navLinks = document.getElementById('nav-links');
const overlay = document.getElementById('menu-overlay');

toggleBtn.addEventListener('click', () => {
  const isOpen = navLinks.classList.toggle('show');
  overlay.classList.toggle('show', isOpen);
  toggleBtn.textContent = isOpen ? '✖' : '☰';
  toggleBtn.classList.toggle("active");
});

overlay.addEventListener('click', () => {
  navLinks.classList.remove('show');
  overlay.classList.remove('show');
  toggleBtn.textContent = '☰';
  toggleBtn.classList.remove("active");
});










document.getElementById('search-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('search-form').submit();
    }
});









document.addEventListener('DOMContentLoaded', function () {
    // Select all language dropdowns
    const langDropdowns = document.querySelectorAll('.lang-dropdown');

    langDropdowns.forEach(dropdown => {
        const langBtn = dropdown.querySelector('.lang-btn');

        // Toggle menu on button click
        langBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });
    });

    // Close all dropdowns when clicking outside
    document.addEventListener('click', function () {
        langDropdowns.forEach(dropdown => dropdown.classList.remove('show'));
    });
});



</script>