<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demander un service</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
  .service-request-form {
  max-width: 500px;
  margin: 60px auto;
  padding: 25px;
  background: #F4F4F4;
  border-radius: 12px;
  box-shadow: 0 0 12px rgba(0,0,0,0.1);
  font-family: 'Poppins', sans-serif;
}

.service-request-form h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #052659;
}

.service-request-form form div {
  margin-bottom: 15px;
}

.service-request-form label {
  display: block;
  font-weight: 600;
  margin-bottom: 5px;
   color: #052659;
}

.service-request-form input,
.service-request-form textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.service-request-form .btn-valider {
  width: 100%;
  background: #052659;
  color: #F4F4F4;
  border: none;
  padding: 10px 0;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
}

.service-request-form .btn-valider:hover {
  background:white;
  color: #052659;
}

</style>
<body>
@include('layouts.navbar')

<div class="service-request-form">
  <h2>Demande pour le service : <span>{{ $service->title }}</span></h2>

  <form action="{{ route('service.request', $service->id) }}" method="POST">
    @csrf
    <div>
      <label>Nom complet :</label>
      <input type="text" name="name" required>
    </div>

    <div>
      <label>Téléphone :</label>
      <input type="text" name="phone" required>
    </div>

    <div>
      <label>Adresse :</label>
      <textarea name="address" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn-valider">Valider la demande</button>
  </form>
</div>




@include('layouts.footer')
</body>
</html>
