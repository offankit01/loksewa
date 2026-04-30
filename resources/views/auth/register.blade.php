<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LokSewa Tayari') }} - Create Account</title>

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
            background-image: radial-gradient(circle at top right, rgba(30,58,138,0.05), transparent 40%),
                              radial-gradient(circle at bottom left, rgba(249,115,22,0.05), transparent 40%);
        }
        .register-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            background: #fff;
        }
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(30, 58, 138, 0.15);
        }
        .brand-logo-container {
            width: 80px;
            height: 80px;
            background: rgba(30, 58, 138, 0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100 py-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card register-card overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="register-header">
                            <a href="{{ url('/') }}" class="text-decoration-none">
                                <div class="brand-logo-container">
                                    <i class="bi bi-person-plus-fill fs-1 text-primary-blue"></i>
                                </div>
                            </a>
                            <h3 class="fw-bold mb-1">Create an Account</h3>
                            <p class="text-muted small">Join thousands of students preparing for LokSewa</p>
                        </div>
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-medium text-dark small mb-1">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input id="name" class="form-control border-start-0 ps-0" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium text-dark small mb-1">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" class="form-control border-start-0 ps-0" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-medium text-dark small mb-1">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" class="form-control border-start-0 ps-0" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-medium text-dark small mb-1">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input id="password_confirmation" class="form-control border-start-0 ps-0" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password">
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary-custom btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                                    Register Account <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                            
                            <div class="text-center mt-4">
                                <p class="text-muted small mb-0">
                                    Already have an account? <a href="{{ route('login') }}" class="text-accent-orange fw-bold text-decoration-none hover-text-primary">Sign in here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
