<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Study Notes | LokSewa Tayari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <style>
        body { background-color: var(--light-bg); padding-top: 76px; }
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .chapter-card { background: white; border: none; border-radius: 1rem; transition: all 0.3s ease; border-left: 5px solid transparent; }
        .chapter-card:hover { transform: translateX(10px); border-left-color: var(--accent-orange); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white border-bottom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-blue d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-journal-bookmark-fill me-2 text-accent-orange"></i> LokSewa Tayari
            </a>
            <div class="ms-auto">
                <a href="{{ route('service.show', $slug) }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </nav>

    <header class="subpage-header">
        <div class="container text-center">
            <h1 class="fw-bold mb-0">{{ $title }} Study Notes</h1>
            <p class="text-white-50 mt-2 mb-0">Master every chapter with expert-curated materials</p>
        </div>
    </header>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Chapter List Mockup -->
                <div class="list-group d-flex flex-column gap-3">
                    @for ($i = 1; $i <= 5; $i++)
                    <div class="chapter-card p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-3 p-3 me-4">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Chapter {{ $i }}: General Introduction & Overview</h5>
                                <p class="text-muted small mb-0">Estimated reading time: 15 mins</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary-custom rounded-pill">Read Now</a>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</body>
</html>
