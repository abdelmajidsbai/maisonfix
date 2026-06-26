<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $service->title }}</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

@include('layouts.navbar')

<div class="service-details">
  <div class="service-image">
    <img src="{{ asset('images/' . $service->image) }}" alt="{{ $service->title }}">
  </div>

  <div class="service-info">
    <h1>{{ $service->name }}</h1>
   
    <p><strong>Description:</strong> {{ $service->description }}</p>
    
    <div class='btn-demander-div'>
      <a href="{{ route('service.request.form', $service->id) }}" class="btn-demander">
        Demander ce service
      </a>
    </div>
    @if(session('success'))
  <div class="alert alert-success" style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px;">
      {{ session('success') }}
  </div>
@endif

     <p class="service-detail">
  <strong>Détails :</strong> {{ $service->details ?? 'Non spécifiée' }}
</p>
  </div>
</div>





<div class="autres-services-meme-category">
  <h2>Autres services similaires</h2>
  <div class="service-categorie-container">
    @foreach($relatedServices as $related)
      <div class="service-categorie-card">
        <a href="{{ route('services.show', $related->id) }}">
          <img src="{{ asset('images/' . $related->image) }}" alt="{{ $related->name }}">
          <h3>{{ $related->name }}</h3>
        </a>
        <div class='btn-more-info-div'>
          <a href="{{ route('services.show', $service->id) }}" class="btn-more-info">More Info</a>
        </div>
      </div>
    @endforeach
  </div>
</div>




@include('layouts.footer')
</body>
</html>
