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
        .profile-info {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .profile-avatar {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .profile-meta { display: flex; flex-direction: column; gap: 3px; }
        .profile-name { font-size: 16px; font-weight: 700; color: #e2f5ec; }
        .profile-email { font-size: 12px; color: #7fb99a; }
        .btn-back {
            display: inline-flex; align-items: center; gap: 7px;
            margin-bottom: 20px;
            padding: 7px 14px;
            border-radius: 9px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            color: #7fb99a; font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { background: rgba(16,185,129,0.10); color: #34d399; }
    </style>
</head>
<body>
<div class="register-bg">
    <div class="register-card">

        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="ph ph-arrow-left"></i> Retour au dashboard
        </a>

        <!-- Infos actuelles -->
        <div class="profile-info">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="profile-meta">
                <span class="profile-name">{{ Auth::user()->name }}</span>
                <span class="profile-email">{{ Auth::user()->email }}</span>
            </div>
        </div>

        <!-- En-tête -->
        <div class="register-header">
            <div class="icon-circle">
                <i class="ph ph-user-gear"></i>
            </div>
            <h2>Mon Profil</h2>
            <p class="subtitle">Modifier mes informations</p>
        </div>

        <!-- Formulaire modification -->
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
                <label for="password">Nouveau mot de passe <span style="color:#3d6b52;font-size:10px;">(laisser vide = inchangé)</span></label>
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
                <label for="password_confirmation">Confirmer</label>
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
                <div style="background:rgba(16,185,129,0.12); border:1px solid rgba(16,185,129,0.25); border-radius:9px; padding:10px 14px; margin-bottom:14px; color:#34d399; font-size:12px; display:flex; align-items:center; gap:7px;">
                    <i class="ph ph-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <button type="submit" class="btn-primary">
                <span>Enregistrer</span>
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