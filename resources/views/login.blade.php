<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Upvity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            gap: 120px;
            padding: 40px 160px;
        }

        /* ===== KIRI ===== */
        .welcome-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            color: white;
            width: 360px;
            flex-shrink: 0;
        }

        .logo-section {
            margin-bottom: 32px;
        }

        .logo-section img {
            width: 110px;
            height: auto;
        }

        .welcome-title {
            font-size: 54px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .welcome-text {
            font-size: 15px;
            line-height: 1.7;
            opacity: 0.95;
        }

        /* ===== KANAN (CARD) ===== */
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 16px 56px rgba(0, 0, 0, 0.25);
            padding: 44px 40px;
            width: 380px;
            flex-shrink: 0;
        }

        .login-card h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .login-card .subtitle {
            color: #9ca3af;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .form-group { margin-bottom: 18px; }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: #f9fafb;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .password-wrapper { position: relative; }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
            font-size: 15px;
            transition: color 0.2s;
        }

        .toggle-password:hover { color: #667eea; }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 24px;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .alert {
            padding: 11px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        @media (max-width: 768px) {
            .welcome-content { display: none; }
            .login-card { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="login-container">

        <!-- Kiri -->
        <div class="welcome-content">
            <div class="logo-section">
                <img src="{{ asset('images/Logo Upvity.png') }}" alt="Logo">
            </div>
            <h1 class="welcome-title">Hey, Halo!</h1>
            <p class="welcome-text">Selamat datang di Sistem Informasi Manajemen Tugas dengan Gamifikasi. Kelola tugas dengan lebih menyenangkan dan dapatkan reward untuk setiap pencapaian!</p>
        </div>

        <!-- Kanan -->
        <div class="login-card">
            <h3>Selamat Datang!</h3>
            <p class="subtitle">Silakan login untuk melanjutkan</p>

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email"
                           class="form-control"
                           name="email"
                           placeholder="Masukkan email Anda"
                           autocomplete="off"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password"
                               class="form-control"
                               name="password"
                               id="password"
                               placeholder="Masukkan password Anda"
                               autocomplete="new-password"
                               required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>