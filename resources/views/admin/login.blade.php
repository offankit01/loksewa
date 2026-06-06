<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lok Siksha') }} - Admin Login</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        body {
            background-color: var(--light-bg);
            background-image: radial-gradient(circle at top right, rgba(30,58,138,0.1), transparent 40%),
                              radial-gradient(circle at bottom left, rgba(249,115,22,0.05), transparent 40%);
        }
        .admin-login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .admin-header {
            background-color: var(--primary-blue);
            color: white;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 2rem;
            text-align: center;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(30, 58, 138, 0.25);
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="text-decoration-none h3 fw-bold text-primary-blue d-inline-flex align-items-center">
                        <i class="bi bi-journal-bookmark-fill me-2 fs-2 text-accent-orange"></i>
                        Lok Siksha
                    </a>
                </div>
                
                <div class="card admin-login-card overflow-hidden">
                    <div class="admin-header">
                        <i class="bi bi-shield-lock fs-1 mb-2"></i>
                        <h4 class="fw-bold mb-0">Admin Portal</h4>
                        <p class="text-white-50 small mb-0">Sign in to manage the platform</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Hidden field to indicate admin attempt (if needed later) -->
                            <input type="hidden" name="is_admin" value="1">

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium text-muted small text-uppercase tracking-wider">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" class="form-control border-start-0 ps-0 bg-light" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@example.com">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password" class="form-label fw-medium text-muted small text-uppercase tracking-wider mb-0">Password</label>
                                    @if (Route::has('password.request'))
                                        <a class="small text-decoration-none text-primary-blue hover-text-primary" href="{{ route('password.request') }}">
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" class="form-control border-start-0 ps-0 bg-light" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label text-muted small" for="remember_me">
                                    Remember me on this device
                                </label>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                                    Sign In securely
                                </button>
                            </div>
                            
                            <div class="text-center mt-4">
                                <a href="{{ route('login') }}" class="text-muted small text-decoration-none hover-text-primary">
                                    <i class="bi bi-arrow-left me-1"></i> Return to Student Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
