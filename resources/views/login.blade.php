<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Mon Application</title>
    
    <!-- Google Fonts : Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icônes : Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="split-container">
        
        <!-- COLONNE GAUCHE : Image avec overlay -->
        <div class="split-left">
            <img src="{{ asset('images/login-image.jpg') }}" alt="Illustration">
            <div class="brand">
                    <i class="ph ph-plant"></i>
                    <span>EcoTech</span>
                </div>
            <div class="image-overlay">
                
                <h1>Bienvenue</h1>
                <p>Connectez-vous pour accéder à votre espace personnel et gérer vos projets en toute simplicité.</p>
                
                <div class="features">
                    <div class="feature">
                        <i class="ph ph-shield-check"></i>
                        <span>Sécurisé</span>
                    </div>
                    <div class="feature">
                        <i class="ph ph-lightning"></i>
                        <span>Rapide</span>
                    </div>
                    <div class="feature">
                        <i class="ph ph-heart"></i>
                        <span>Intuitif</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE : Formulaire -->
        <div class="split-right">
            <div class="login-box">
                
                <!-- En-tête -->
                <div class="login-header">
                    <div class="icon-circle">
                        <i class="ph ph-lock-key-open"></i>
                    </div>
                    <h2>Connexion</h2>
                    <p class="subtitle">Entrez vos identifiants pour continuer</p>
                </div>

                <!-- Message de succès -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="ph ph-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Formulaire -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <div class="input-wrapper">
                            <i class="ph ph-envelope"></i>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                placeholder="nom@exemple.com"
                                required
                                autofocus
                            >
                        </div>
                        @error('email')
                            <div class="error">
                                <i class="ph ph-warning-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="label-row">
                            <label for="password">Mot de passe</label>
                            <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                        </div>
                        <div class="input-wrapper">
                            <i class="ph ph-lock"></i>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••"
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="ph ph-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="remember-me">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="checkmark"></span>
                            <span class="label-text">Se souvenir de moi</span>
                        </label>
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn-primary">
                        <span>Se connecter</span>
                        <i class="ph ph-arrow-right"></i>
                    </button>
                </form>

         <div class="register-link">
    <span>Pas encore de compte ?</span>
    <a href="{{ route('register') }}">Créer un compte </a>
</div>

            </div>
        </div>

    </div>

    <!-- Script pour afficher/masquer le mot de passe -->
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            
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