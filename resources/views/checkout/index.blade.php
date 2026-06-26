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
    

<h2 class='checkout'>Checkout - Paiement à la livraison</h2>

<form action="{{ route('checkout.store') }}" method="POST" class='checkout-form'>
    @csrf
    <div>
        <label>Nom:</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Téléphone:</label>
        <input type="text" name="phone" required>
    </div>
    <div>
        <label>Adresse:</label>
        <textarea name="address" required></textarea>
    </div>
    <button type="submit" style="padding:10px 20px; margin-top:10px; border:none; border-radius:5px;">Passer la commande</button>
</form>

</body>
</html>



















