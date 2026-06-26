<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class='dashboard-section'>
    @include('dashboard.dashboard_nav')


    <div class='dashboard-donnes'>
      @yield('dashboard_content')
    </div>
  </div>



<script>
  document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.querySelector(".mobile-menu-toggle");
  const overlay = document.querySelector(".mobile-menu-overlay");
  const closeBtn = document.querySelector(".mobile-menu-content .close-menu");

  toggleBtn.addEventListener("click", () => {
    overlay.style.display = "block";
    overlay.classList.add("active");
  });

  closeBtn.addEventListener("click", () => {
    overlay.classList.remove("active");
    setTimeout(() => overlay.style.display = "none", 300); // wait for slide-out
  });

  // Optional: close if click outside panel
  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
      overlay.classList.remove("active");
      setTimeout(() => overlay.style.display = "none", 300);
    }
  });
});

</script>

</body>
</html>