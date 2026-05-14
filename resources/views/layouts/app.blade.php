<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Mon App</title>
    
    {{-- Vite compile automatiquement resources/css/app.css --}}
    @vite(['resources/css/app.css'])
</head>
<body>
    @yield('content')
</body>
</html>