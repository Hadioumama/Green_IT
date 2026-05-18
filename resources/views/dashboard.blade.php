<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<nav class="navbar">
    <span class="logo">Mon Application</span>
    <div class="nav-right">
        <span class="user-name">👤 {{ $user->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Déconnexion</button>
        </form>
    </div>
</nav>

<main class="container">
    <div class="card">
        <h1>Bienvenue, {{ $user->name }} !</h1>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Rôle :</strong> {{ $user->role }}</p>
    </div>

    {{-- ✅ BOUTONS D'ACCÈS --}}
    <div class="card" style="margin-top: 20px;">
        <h2>Navigation</h2>
        <a href="{{ route('devicesindex') }}" class="btn">📋 Gérer les équipements</a>
        <a href="{{ route('energy.index') }}" class="btn" style="margin-left:10px;">⚡ Consommation énergétique</a>
    </div>
</main>

</body>
</html>