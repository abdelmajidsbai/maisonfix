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
  <div class="contact-page">
    
    <div class='contact-image'>
       <img id="image0" src="{{asset('images/contact-img.png')}}" class="" style="">
    </div>

   <div class='contact-info'>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div>
            <label>{{ __('messages.name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>{{ __('messages.subject') }}</label>
            <input type="text" name="subject" value="{{ old('subject') }}">
            @error('subject') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>{{ __('messages.message') }}</label>
            <textarea name="message">{{ old('message') }}</textarea>
            @error('message') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit">{{ __('messages.send') }}</button>
    </form>
   </div>
   
</div>

@include('layouts.footer')
</body>
</html>
