<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<!-- FOND IMAGE + OVERLAY -->
<div class="register-bg">
    
    <!-- CARTE NUDE CENTRÉE -->
    <div class="register-card">
        
        <!-- En-tête -->
        <div class="register-header">
            <div class="icon-circle">
                <i class="ph ph-user-plus"></i>
            </div>
            <h2>Inscription</h2>
            <p class="subtitle">Créez votre compte</p>
        </div>

        <!-- Formulaire -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom -->
            <div class="form-group">
                <label for="name">Nom complet</label>
                <div class="input-wrapper">
                    <i class="ph ph-user"></i>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        placeholder=""
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >
                </div>
                @error('name')
                    <div class="error">
                        <i class="ph ph-warning-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Adresse email</label>
                <div class="input-wrapper">
                    <i class="ph ph-envelope"></i>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        placeholder="***@exemple.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
                @error('email')
                    <div class="error">
                        <i class="ph ph-warning-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-wrapper">
                    <i class="ph ph-lock"></i>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        placeholder="••••••••"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password', 'eye-pass')">
                        <i class="ph ph-eye" id="eye-pass"></i>
                    </button>
                </div>
            </div>

            <!-- Confirmation -->
            <div class="form-group">
                <label for="password_confirmation">Confirmer</label>
                <div class="input-wrapper">
                    <i class="ph ph-lock-key"></i>
                    <input 
                        type="password" 
                        id="password_confirmation"
                        name="password_confirmation" 
                        placeholder="••••••••"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'eye-confirm')">
                        <i class="ph ph-eye" id="eye-confirm"></i>
                    </button>
                </div>
            </div>

            <!-- Bouton -->
            <button type="submit" class="btn-primary">
                <span>S'inscrire</span>
                <i class="ph ph-arrow-right"></i>
            </button>
        </form>

        <!-- Lien login -->
        <div class="login-link">
            <span>Déjà un compte ?</span>
            <a href="{{ route('login') }}">Se connecter</a>
        </div>

    </div>

</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('ph-eye', 'ph-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('ph-eye-slash', 'ph-eye');
        }
    }
</script>

</body>
</html>