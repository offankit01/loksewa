<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $site_settings['site_name'] ?? 'LokSewa Tayari' }} - Forgot Password</title>

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
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            margin: 0;
        }
        .auth-card {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }
        .auth-header {
            background: linear-gradient(135deg, var(--dark-navy) 0%, #1e293b 100%);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }
        .auth-body {
            padding: 3rem;
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
        .btn-primary-blue {
            background: linear-gradient(to right, var(--primary-blue), #1e40af);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-primary-blue:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.2);
            color: white;
        }
        .icon-box {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <div class="icon-box">
                <i class="bi bi-key-fill fs-1"></i>
            </div>
            <h2 class="fw-bold mb-0">Forgot Password?</h2>
            <p class="text-white-50 mt-2">No worries, we'll send you reset instructions.</p>
        </div>

        <div class="auth-body">
            @if (session('status'))
                <div class="alert alert-success border-0 rounded-4 mb-4 small py-3 px-4 fw-bold">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">EMAIL ADDRESS</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="e.g. yourname@example.com">
                    @error('email')
                        <div class="text-danger extra-small mt-2 fw-bold"><i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary-blue">
                        SEND RESET LINK <i class="bi bi-send-fill ms-2"></i>
                    </button>
                    
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-muted small fw-bold">
                        <i class="bi bi-arrow-left me-2"></i>Back to login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
