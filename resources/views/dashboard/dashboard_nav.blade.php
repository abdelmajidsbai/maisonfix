
<div class="dashbord-nav desktop-nav">
  <div class='deconecter'>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class='deconecter-button'>Déconnexion</button>
    </form>
  </div>

  <div class='dashboard-categories-products-services'>
    <div><a href="{{ route('dashboard.index') }}">Statistiques</a></div>
    <div class='dasboard-categories'><a href="{{ route('dashboard.categories.index') }}">Gestion categories</a></div>
    <div class='dasboard-categories'><a href="{{ route('dashboard.offres.index') }}">Gestion Offres</a></div>
    <div class='dasboard-products'><a href="{{ route('dashboard.products.index') }}">Gestion produits</a></div>
    <div class='dasboard-services'><a href="{{ route('dashboard.services.index') }}">Gestion services</a></div>
  </div>

  <div class='dashboard-orders'>
    <a href="{{ route('dashboard.orders.index') }}">Orders produits</a>
    <ul class='gere-orders'>
      <li><a href="{{ route('dashboard.orders.pending') }}">Orders not validées</a></li>
      <li><a href="{{ route('dashboard.orders.validated') }}">Orders validées</a></li>
    </ul>
  </div>

  <div class='dashboard-services'>
    <a href="{{ route('dashboard.service_orders.index') }}">Services demandes</a>
    <ul class='gere-services'>
      <li><a href="{{ route('dashboard.service_orders.pending') }}">Services not validés</a></li>
      <li><a href="{{ route('dashboard.service_orders.validated') }}">Services validés</a></li>
    </ul>
  </div>
</div>


<!-- Mobile Dashboard Nav -->
<!-- Mobile Dashboard Nav -->
<div class="mobile-nav">
  <div class='header-nav-mobile'>
    <button class="mobile-menu-toggle">☰ Menu</button>
    <div class='deconecter'>
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class='deconecter-button'>Déconnexion</button>
        </form>
    </div>
  </div>
  

  <div class="mobile-menu-overlay">
    <div class="mobile-menu-content">
      <button class="close-menu">&times;</button>
      
      

      <div class='dashboard-categories-products-services'>
        <div><a href="{{ route('dashboard.index') }}">Statistiques</a></div>
        <div class='dasboard-categories'><a href="{{ route('dashboard.categories.index') }}">Gestion categories</a></div>
        <div class='dasboard-categories'><a href="{{ route('dashboard.offres.index') }}">Gestion Offres</a></div>
        <div class='dasboard-products'><a href="{{ route('dashboard.products.index') }}">Gestion produits</a></div>
        <div class='dasboard-services'><a href="{{ route('dashboard.services.index') }}">Gestion services</a></div>
        <div class='dashboard-orders'>
          <a href="{{ route('dashboard.orders.index') }}">Orders produits</a>
          <ul class='gere-orders'>
            <li><a href="{{ route('dashboard.orders.pending') }}">Orders not validées</a></li>
            <li><a href="{{ route('dashboard.orders.validated') }}">Orders validées</a></li>
          </ul>
        </div>

        <div class='dashboard-services'>
          <a href="{{ route('dashboard.service_orders.index') }}">Services demandes</a>
          <ul class='gere-services'>
            <li><a href="{{ route('dashboard.service_orders.pending') }}">Services not validés</a></li>
            <li><a href="{{ route('dashboard.service_orders.validated') }}">Services validés</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</div>