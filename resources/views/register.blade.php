<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Inscription</h2>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nom"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Mot de passe"><br>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>