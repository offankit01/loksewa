@extends('layouts.main')

@section('title', $title . ' - Study Notes | LokSewa Tayari')

@section('extra_css')
    <style>
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .chapter-card { background: white; border: none; border-radius: 1rem; transition: all 0.3s ease; border-left: 5px solid transparent; }
        .chapter-card:hover { transform: translateX(10px); border-left-color: var(--accent-orange); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
@endsection

@section('content')
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
@endsection
