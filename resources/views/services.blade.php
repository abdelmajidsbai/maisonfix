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
  <div class='slider-services'>
    <img id="image0" src="{{asset('images/camera1.jpg')}}" class="" >
    <h1>{{ __('messages.services') }}</h1>
  </div>

  <div class='services-page-section'>

    

    <div class='services-container'>
    @foreach($services as $service)
      <div class='service-card'>
        @if($service->image)
          <img src="{{asset('images/'.$service->image)}}" alt="">
        @endif
        <div class='service-description'>
          <h3>{{$service->name}}</h3>
          <p>{{$service->description}}</p>
          <div class='btn-more-info-div'>
            <a href="{{ route('services.show', $service->id) }}" class="btn-more-info">{{ __('messages.more_info') }}</a>
          </div>
          

          <!-- Demander ce service -->

        </div>
      </div>
    @endforeach
  </div>

  </div>


  @include('layouts.footer')
</body>
</html>