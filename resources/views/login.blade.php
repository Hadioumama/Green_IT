<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="auth-box">
    <h2>Connexion</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="form-group">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>

        <button type="submit" class="btn-primary">Se connecter</button>
    </form>

    <p class="auth-link">
        Pas encore de compte ? <a href="/register">S'inscrire</a>
    </p>
</div>

</body>
</html>