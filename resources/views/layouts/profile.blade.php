<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <style>
       /* ═══════════════════════════════════════════════ */
/* PAGE PROFIL — AMÉLIORATIONS GREEN IT            */
/* ═══════════════════════════════════════════════ */

/* Fond avec overlay plus profond */
.register-bg {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
    position: relative;
}

.register-bg::before {
    content: '';
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg,
        rgba(2, 12, 8, 0.65) 0%,
        rgba(3, 18, 14, 0.55) 50%,
        rgba(2, 10, 18, 0.70) 100%
    );
    z-index: 0;
    pointer-events: none;
}

/* Carte principale — glassmorphism amélioré */
.register-card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 460px;
    background: rgba(104, 120, 112, 0.55);
    backdrop-filter: blur(24px) saturate(160%);
    -webkit-backdrop-filter: blur(24px) saturate(160%);
    border-radius: 22px;
    border: 1px solid rgba(52, 211, 153, 0.15);
    box-shadow:
        0 32px 80px rgba(0, 0, 0, 0.5),
        0 0 60px rgba(16, 185, 129, 0.06) inset,
        0 1px 0 rgba(255, 255, 255, 0.08) inset;
     padding: 24px 32px; 
    animation: cardIn 0.7s cubic-bezier(0.4, 0, 0.2, 1) both;
}

@keyframes cardIn {
    from { opacity: 0; transform: scale(0.96) translateY(20px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

/* Bouton retour — style glass */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px; 
    padding: 8px 16px;
    border-radius: 10px;
    background: rgba(16, 185, 129, 0.08);
    border: 1px solid rgba(52, 211, 153, 0.12);
    color: #34d399;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.25s;
    letter-spacing: 0.02em;
}

.btn-back:hover {
    background: rgba(16, 185, 129, 0.15);
    border-color: rgba(52, 211, 153, 0.25);
    color: #6ee7b7;
    transform: translateX(-2px);
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.1);
}

.btn-back i {
    font-size: 14px;
}

/* Info profil — badge glassmorphism */
.profile-info {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(52, 211, 153, 0.10);
    border-radius: 16px;
    padding: 18px 20px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s;
}

.profile-info:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(52, 211, 153, 0.18);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.08);
}

.profile-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
}

.profile-meta {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.profile-name {
    font-size: 17px;
    font-weight: 700;
    color: #f0fdf4;
    letter-spacing: 0.01em;
}

.profile-email {
    font-size: 13px;
    color: #6ee7b7;
    font-weight: 400;
}

/* En-tête du formulaire */
.register-header {
    text-align: center;
    margin-bottom: 24px;
}

.icon-circle {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.3));
    border: 1px solid rgba(52, 211, 153, 0.2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    font-size: 28px;
    color: #34d399;
    box-shadow: 0 8px 32px rgba(16, 185, 129, 0.15);
    animation: iconPulse 3s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% { box-shadow: 0 8px 32px rgba(16, 185, 129, 0.15); }
    50% { box-shadow: 0 8px 40px rgba(16, 185, 129, 0.25); }
}

.register-header h2 {
    font-size: 22px;
    font-weight: 700;
    color: #f0fdf4;
    margin-bottom: 4px;
    letter-spacing: -0.01em;
}

.subtitle {
    font-size: 13px;
    color: #6ee7b7;
    font-weight: 400;
}

/* Groupes de formulaire */
.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #a7f3d0;
    letter-spacing: 0.02em;
}

/* Input wrapper — glassmorphism */
.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(52, 211, 153, 0.12);
    border-radius: 12px;
    padding: 0 14px;
    height: 44px;
    transition: all 0.25s;
}

.input-wrapper:focus-within {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(52, 211, 153, 0.35);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1), 0 4px 20px rgba(16, 185, 129, 0.08);
}

.input-wrapper i {
    font-size: 18px;
    color: #34d399;
    margin-right: 12px;
    flex-shrink: 0;
}

.input-wrapper input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: #f0fdf4;
    font-size: 14px;
    font-weight: 500;
    height: 100%;
    width: 100%;
}

.input-wrapper input::placeholder {
    color: #6b9c82;
    font-weight: 400;
}

/* Toggle password */
.toggle-password {
    background: transparent;
    border: none;
    color: #6ee7b7;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s;
    flex-shrink: 0;
}

.toggle-password:hover {
    color: #34d399;
}

/* Message d'erreur */
.error {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    padding: 8px 12px;
    background: rgba(239, 68, 68, 0.08);
    border: 1px solid rgba(239, 68, 68, 0.15);
    border-radius: 8px;
    color: #fca5a5;
    font-size: 12px;
    font-weight: 500;
}

.error i {
    font-size: 14px;
    color: #f87171;
}

/* Message succès amélioré */
.success-msg {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(52, 211, 153, 0.2);
    border-radius: 12px;
    padding: 12px 16px;
    margin-bottom: 20px;
    color: #6ee7b7;
    font-size: 13px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideIn 0.4s ease;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.success-msg i {
    font-size: 18px;
    color: #34d399;
}

/* Bouton principal */
.btn-primary {
    width: 100%;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #10b981, #059669);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 8px;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
    letter-spacing: 0.02em;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #34d399, #10b981);
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(16, 185, 129, 0.4);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-primary i {
    font-size: 18px;
}

/* Note sous label */
.form-group label span {
    color: #6b9c82;
    font-size: 11px;
    font-weight: 400;
    margin-left: 4px;
}

/* Responsive */
@media (max-width: 520px) {
    .register-card {
        padding: 28px 24px;
        border-radius: 18px;
    }
    
    .profile-avatar {
        width: 48px;
        height: 48px;
        font-size: 20px;
    }
    
    .register-header h2 {
        font-size: 22px;
    }
}
    </style>
</head>
<body>
<div class="register-bg">
    <div class="register-card">

        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="ph ph-arrow-left"></i> Retour au dashboard
        </a>
        <!-- En-tête -->
        <div class="register-header">
            <div class="icon-circle">
                <i class="ph ph-user-gear"></i>
            </div>
            <h2>Mon Profil</h2>
            <p class="subtitle">Modifier mes informations</p>
        </div>

        <!-- Formulaire -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Nom complet</label>
                <div class="input-wrapper">
                    <i class="ph ph-user"></i>
                    <input type="text" id="name" name="name"
                        value="{{ Auth::user()->name }}" required>
                </div>
                @error('name')
                    <div class="error"><i class="ph ph-warning-circle"></i><span>{{ $message }}</span></div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <div class="input-wrapper">
                    <i class="ph ph-envelope"></i>
                    <input type="email" id="email" name="email"
                        value="{{ Auth::user()->email }}" required>
                </div>
                @error('email')
                    <div class="error"><i class="ph ph-warning-circle"></i><span>{{ $message }}</span></div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">
                    Nouveau mot de passe
                    <span>(laisser vide = inchangé)</span>
                </label>
                <div class="input-wrapper">
                    <i class="ph ph-lock"></i>
                    <input type="password" id="password" name="password"
                        placeholder="••••••••">
                    <button type="button" class="toggle-password" onclick="togglePassword('password','eye-pass')">
                        <i class="ph ph-eye" id="eye-pass"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <div class="input-wrapper">
                    <i class="ph ph-lock-key"></i>
                    <input type="password" id="password_confirmation"
                        name="password_confirmation" placeholder="••••••••">
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation','eye-confirm')">
                        <i class="ph ph-eye" id="eye-confirm"></i>
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="success-msg">
                    <i class="ph ph-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <button type="submit" class="btn-primary">
                <span>Enregistrer les modifications</span>
                <i class="ph ph-floppy-disk"></i>
            </button>
        </form>

    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('ph-eye','ph-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('ph-eye-slash','ph-eye');
    }
}
</script>
</body>
</html>