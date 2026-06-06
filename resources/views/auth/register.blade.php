<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $site_settings['site_name'] ?? 'Lok Siksha' }} - Create Account</title>

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
            height: 100vh;
            width: 100%;
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            overflow: hidden;
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
            padding: 1.5rem;
            z-index: 2;
            height: 100%;
            overflow: hidden !important;
        }
        @media (min-width: 992px) {
            .visual-side { display: flex; }
            .form-side { padding: 2rem 4rem; max-width: 650px; }
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
            border-color: var(--accent-orange);
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        }
        .btn-register {
            background: linear-gradient(to right, var(--accent-orange), #ea580c);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(234, 88, 12, 0.2);
            transition: all 0.3s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(234, 88, 12, 0.3);
            color: white;
        }
        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .step-badge {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: var(--accent-orange);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
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
        .letter-spacing-1 { letter-spacing: 1px; }
        .bg-primary-soft { background-color: rgba(30, 58, 138, 0.08); }
        .text-primary-blue { color: var(--primary-blue); }
        .extra-small { font-size: 0.7rem; }
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
                <h4 class="fw-bold mb-4">Why join us?</h4>
                <ul class="list-unstyled d-flex flex-column gap-4 mb-0">
                    <li class="d-flex align-items-center gap-3">
                        <div class="step-badge"><i class="bi bi-check-lg"></i></div>
                        <div>
                            <div class="fw-bold">Free Practice Sets</div>
                            <div class="small text-white-50">Access over 500+ free mock tests</div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center gap-3">
                        <div class="step-badge"><i class="bi bi-cloud-arrow-down"></i></div>
                        <div>
                            <div class="fw-bold">Offline Downloads</div>
                            <div class="small text-white-50">Save study notes for offline use</div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center gap-3">
                        <div class="step-badge"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <div class="fw-bold">Smart Analytics</div>
                            <div class="small text-white-50">Track your progress and rankings</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="position-absolute bottom-0 start-0 p-5 text-white-50 small">
                &copy; {{ date('Y') }} {{ $site_settings['site_name'] ?? 'Lok Siksha' }} Platform
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="mx-auto w-100" style="max-width: 400px; padding-bottom: 2rem;">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Create Account</h2>
                    <p class="text-muted small mb-0">Join thousands of scholars today.</p>
                </div>

                {{-- Social Logins --}}
                <div class="mb-4">
                    <a href="{{ route('social.redirect', 'google') }}" class="btn btn-outline-light w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 border text-dark fw-bold social-btn" style="font-size: 0.9rem;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="height: 18px;">
                        Sign up with Google
                    </a>
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <hr class="flex-grow-1 text-muted opacity-25 m-0">
                    <span class="extra-small fw-bold text-muted text-uppercase letter-spacing-1" style="font-size: 0.65rem;">OR CONTINUE WITH EMAIL</span>
                    <hr class="flex-grow-1 text-muted opacity-25 m-0">
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label extra-small fw-bold text-muted text-uppercase mb-1">Full Name</label>
                        <input id="name" class="form-control form-control-sm py-2" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Ankit Kumar">
                        @error('name')
                            <div class="text-danger extra-small mt-1 fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label class="form-label extra-small fw-bold text-muted text-uppercase mb-1">Email Address</label>
                        <input id="email" class="form-control form-control-sm py-2" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="your@email.com">
                        @error('email')
                            <div class="text-danger extra-small mt-1 fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label extra-small fw-bold text-muted text-uppercase mb-1">Password</label>
                        <div class="position-relative">
                            <input id="password" class="form-control form-control-sm py-2" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                            <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted px-2" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger extra-small mt-1 fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label extra-small fw-bold text-muted text-uppercase mb-1">Confirm Password</label>
                        <div class="position-relative">
                            <input id="password_confirmation" class="form-control form-control-sm py-2" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                            <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted px-2" onclick="togglePassword('password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="terms" required checked>
                        <label class="form-check-label extra-small text-muted" for="terms">
                            I agree to the <a href="#" class="text-accent-orange fw-bold text-decoration-none">Terms</a> and <a href="#" class="text-accent-orange fw-bold text-decoration-none">Privacy</a>.
                        </label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-register shadow-sm py-2">
                            CREATE ACCOUNT <i class="bi bi-chevron-right ms-1"></i>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted extra-small mb-0">
                            Already have an account? <a href="{{ route('login') }}" class="text-primary-blue fw-bold text-decoration-none">Sign In</a>
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
