<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <title>Document</title>
</head>
<body>
  <footer class='footer'>
    <div class='footer-container'>
      <div class='footer-about'>
        <a href="/">
          <img src="{{asset('images/logooo.png')}}" alt="" class="desktop-logo-img">
        </a>
        
        <p>Chez MAISON FIX, nous sommes spécialisés dans l’installation de caméras de sécurité, de systèmes électriques et dans la réparation générale de la maison.
           Notre mission est de garantir votre confort et votre sécurité grâce à des services rapides, fiables et professionnels.</p>
      </div>

      <div class='footer-links'>
        <h4>liens rapides</h4>
        <ul>
          <li><a href="{{url('/')}}">Accueil</a></li>
          <li><a href="{{url('/produits')}}">Produits</a></li>
          <li><a href="{{url('/services')}}">Services</a></li>
          <li><a href="{{url('/contact')}}">Contact</a></li>
        </ul>
      </div>

      <div class='footer-contact'>
        <h4>Contact</h4>
        <p> Telephone / WhatsApp : 0606060606</p>
        <p>Email : maisonfix@gmail.com</p>
      </div>

      <div class='footer-contact'>
        <h4>Follow us</h4>
        <ul class='media'>
          <li><a href=""><i class="icon-social-facebook"></i></a></li>
          <li><a href=""><i class="icon-social-instagram"></i></a></li>
        </ul>
      </div>

    </div>
    <div class='footer-bottom'>
      <p> {{date('Y')}} Sbai Electric - Tous droit reserves</p>
    </div>
  </footer>









  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


  (function($){
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });


  // === Quantity increase/decrease ===
  $(document).on('click', '.qty-btn', function(e){
    e.preventDefault();
    const $btn = $(this);
    const $form = $btn.closest('.add-to-cart-form');
    const $input = $form.find('.quantity');
    const $display = $form.find('.quantity-value');

    let quantity = parseInt($input.val()) || 1;

    if ($btn.hasClass('increase')) quantity++;
    else if ($btn.hasClass('decrease') && quantity > 1) quantity--;

    $input.val(quantity);
    $display.text(quantity);
  });


  $(document).on('submit', '.add-to-cart-form', function(e){
    e.preventDefault();
    const $form = $(this);
    const url = $form.attr('action');
    const data = $form.serialize();
    const $btn = $form.find('button[type="submit"]');
    const orig = $btn.html();

    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

    $.post(url, data)
      .done(function(res){
        if(res && res.success){
          
          $('#cart-count, .cart-count').text(res.cart_count ?? 0);

          showToast('Ton produit a été enregistré au panier');
        }
      })
      .fail(function(){
        showToast('Erreur serveur', true);
      })
      .always(function(){
        $btn.prop('disabled', false).html(orig);
      });
  });

  // === Toast function ===
  function showToast(message, isError = false){
    $('.ajax-toast').remove(); // remove old toasts if exist

    const toast = $(`
      <div class="ajax-toast ${isError ? 'error' : ''}">
        <span>${message}</span>
        <button class="close-toast">&times;</button>
      </div>
    `);

    $('body').append(toast);
    setTimeout(() => toast.addClass('show'), 100);

    const timer = setTimeout(() => toast.fadeOut(300, () => toast.remove()), 3000);

    toast.find('.close-toast').on('click', function(){
      clearTimeout(timer);
      toast.fadeOut(200, () => toast.remove());
    });
  }

})(jQuery);






  function showToast(message) {
    // Remove old toast if exists
    $('.ajax-toast').remove();

    // Create new toast
    const toast = $(`
      <div class="ajax-toast">
        <span>${message}</span>
        <button class="close-toast">&times;</button>
      </div>
    `);

    $('body').append(toast);

    // Animate in
    setTimeout(() => toast.addClass('show'), 100);

    // Auto remove after 3 seconds
    const timer = setTimeout(() => toast.fadeOut(300, () => toast.remove()), 3000);

    // Manual close
    toast.find('.close-toast').on('click', function() {
        clearTimeout(timer);
        toast.fadeOut(200, () => toast.remove());
    });
}
</script>
</body>
</html>