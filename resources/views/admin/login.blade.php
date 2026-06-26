<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { display:flex; justify-content:center; align-items:center; height:100vh; font-family:Poppins, sans-serif; background:#f5f5f5;}
        .login-container { background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); width:300px;}
        .login-container h2 { text-align:center; margin-bottom:20px;}
        .login-container input { width:100%; padding:10px; margin-bottom:15px; border-radius:5px; border:1px solid #ccc;}
        .login-container button { width:100%; padding:10px; border:none; background:#007bff; color:#fff; border-radius:5px; cursor:pointer;}
        .error { color:red; text-align:center; margin-bottom:10px;}
    </style>
</head>
<body>
<div class="login-container">
    <h2>Connexion Admin</h2>
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    @if($errors->any())
        <div class="error" id="error-message">{{ $errors->first() }}</div>
    @endif
</div>

<script>
    const errorDiv = document.getElementById('error-message');
    if(errorDiv && errorDiv.textContent.includes('Réessayez dans')) {
        let match = errorDiv.textContent.match(/(\d+)\s*secondes/);
        if(match) {
            let seconds = parseInt(match[1]);
            const originalText = errorDiv.textContent;
            const interval = setInterval(() => {
                if(seconds <= 0) {
                    errorDiv.textContent = "Vous pouvez réessayer maintenant.";
                    clearInterval(interval);
                } else {
                    errorDiv.textContent = originalText.replace(/\d+\s*secondes/, seconds + " secondes");
                    seconds--;
                }
            }, 1000);
        }
    }
</script>
</body>
</html>
