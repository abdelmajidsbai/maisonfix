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
  /* PAGE-LOCAL - safe, only for this view */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* wrapper that uses full viewport but won't force extra scroll */
    body.not-found-layout {
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* take viewport height */
    }

    /* content area that will take remaining space between navbar and footer */
    .not-found-page {
      flex: 1 0 auto;               /* grow to fill available space */
      display: flex;
      align-items: center;          /* vertical centering */
      justify-content: center;      /* horizontal centering */
      padding: 24px;                /* moderate padding (not too large) */
      box-sizing: border-box;
      text-align: center;
      overflow: auto;               /* avoid overflow pushing footer down */
    }

    /* inner card to avoid padding affecting centering */
    .notfound-card {
      max-width: 900px;
      width: 100%;
      padding: 18px;
      box-sizing: border-box;
    }

    /* Make sure included footer is in normal flow */
    .not-found-footer {
      flex-shrink: 0;
    }

    /* optional niceties */
    .notfound-card h1 { font-size: 2.2rem; margin: 0 0 10px; }
    .notfound-card p  { margin: 0 0 16px; color: #444; font-size: 1.05rem; }
    .notfound-cta {
      display:inline-block;
      padding:10px 18px;
      background:#007bff;
      color:#fff;
      text-decoration:none;
      border-radius:6px;
    }
</style>
</head>
<body class="not-found-layout">
 

@include('layouts.navbar')

  <main class="not-found-page">
    <div class="notfound-card">
      <h1>Contenu introuvable</h1>
      <p>Cette page n’est pas disponible.</p>
      <a href="{{ url('/') }}" class="notfound-cta">Retour à l’accueil</a>
    </div>
  </main>

  <div class="not-found-footer">
    @include('layouts.footer')
  </div>
</body>
</html>