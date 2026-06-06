<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $site_settings['site_name'] ?? 'Lok Siksha' }} - Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        :root {
            --primary-blue: #1e3a8a;
            --accent-orange: #f97316;
            --dark-navy: #0f172a;
        }
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100vh;
            width: 100%;
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }
        .split-container {
            display: flex;
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .visual-side {
            flex: 1;
            background: linear-gradient(135deg, var(--dark-navy) 0%, #1e293b 100%);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            position: relative;
            height: 100%;
            color: white;
            overflow: hidden;
        }
        .visual-side::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(249,115,22,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .form-side {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem 1.5rem;
            z-index: 2;
            height: 100%;
            overflow-y: auto;
        }
        @media (min-width: 992px) {
            .visual-side { display: flex; }
            .form-side { padding: 4rem 6rem; max-width: 650px; }
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
        }
        .form-control {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 0.85rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .form-control:focus {
            background-color: white;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }
        .btn-login {
            background: linear-gradient(to right, var(--primary-blue), #1e40af);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.2);
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(30, 58, 138, 0.3);
            color: white;
        }
        .social-btn {
            transition: all 0.3s;
            border-color: #e2e8f0 !important;
        }
        .social-btn:hover {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            transform: translateY(-2px);
        }
        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .letter-spacing-1 { letter-spacing: 1px; }
    </style>
</head>
<body>

    <div class="split-container">
        <!-- Visual Side -->
        <div class="visual-side">
            <div class="text-center mb-5">
                <a href="{{ url('/') }}" class="text-decoration-none text-white d-inline-flex align-items-center gap-3 mb-5">
                    <img src="/storage/logo1.png" alt="Logo" style="height: 50px; width: auto; filter: brightness(0) invert(1);">
                    <h2 class="fw-bold m-0">{{ $site_settings['site_name'] ?? 'Lok Siksha' }}</h2>
                </a>
            </div>

            <div class="glass-card floating-icon">
                <h4 class="fw-bold mb-4">Welcome Back, Scholar!</h4>
                <p class="text-white-50 mb-5">Continue your journey towards excellence. Log in to access your dashboard, saved materials, and mock test results.</p>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-shield-check text-accent-orange fs-4"></i>
                        <span class="small">Secure Authentication</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-lightning-charge text-accent-orange fs-4"></i>
                        <span class="small">Instant Access to Study Sets</span>
                    </div>
                </div>
            </div>

            <div class="position-absolute bottom-0 start-0 p-5 text-white-50 small">
                &copy; {{ date('Y') }} {{ $site_settings['site_name'] ?? 'Lok Siksha' }} Platform
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="mx-auto w-100" style="max-width: 450px;">
                <div class="mb-5">
                    <h2 class="fw-bold text-dark mb-2">Welcome Back!</h2>
                    <p class="text-muted">Enter your credentials to continue.</p>
                </div>

                {{-- Error Messages --}}
                @if (session('error'))
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-exclamation-octagon-fill fs-4 text-danger"></i>
                            <div>
                                <div class="fw-bold">Login Error</div>
                                <div class="small">{{ session('error') }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 py-3">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Social Logins --}}
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <a href="{{ route('social.redirect', 'google') }}" class="btn btn-outline-light w-100 py-3 rounded-4 d-flex align-items-center justify-content-center gap-3 border text-dark fw-bold social-btn">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="height: 20px;">
                            Sign in with Google
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <hr class="flex-grow-1 text-muted opacity-25">
                    <span class="extra-small fw-bold text-muted text-uppercase letter-spacing-1">OR CONTINUE WITH EMAIL</span>
                    <hr class="flex-grow-1 text-muted opacity-25">
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email Address -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">EMAIL ADDRESS</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" 
                               required autofocus autocomplete="username" placeholder="e.g. yourname@example.com">
                        @error('email')
                            <div class="text-danger extra-small mt-2 fw-bold"><i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label small fw-bold text-muted mb-0">PASSWORD</label>
                            @if (Route::has('password.request'))
                                <a class="extra-small text-decoration-none text-accent-orange fw-bold" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="position-relative">
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                            <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted pe-3" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger extra-small mt-2 fw-bold"><i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-5">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-check-label small text-muted" for="remember_me">
                            Keep me logged in
                        </label>
                    </div>

                    <div class="d-grid mb-5">
                        <button type="submit" class="btn btn-login btn-lg shadow">
                            SIGN IN <i class="bi bi-chevron-right ms-2"></i>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted small">
                            Don't have an account? <a href="{{ route('register') }}" class="text-primary-blue fw-bold text-decoration-none">Create Account</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>
