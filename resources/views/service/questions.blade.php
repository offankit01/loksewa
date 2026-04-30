@extends('layouts.main')

@section('title', $title . ' - Question Bank | LokSewa Tayari')

@section('extra_css')
    <style>
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .paper-card { background: white; border: none; border-radius: 1rem; overflow: hidden; height: 100%; transition: all 0.3s ease; }
        .paper-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
@endsection

@section('content')
    <header class="subpage-header">
        <div class="container text-center">
            <h1 class="fw-bold mb-0">{{ $title }} Question Bank</h1>
            <p class="text-white-50 mt-2 mb-0">Past exam papers and model questions with full solutions</p>
        </div>
    </header>

    <div class="container pb-5">
        <div class="row g-4">
            @foreach(['2080', '2079', '2078', 'Model Set 1', 'Model Set 2'] as $year)
            <div class="col-md-4">
                <div class="paper-card shadow-sm p-4 text-center">
                    <div class="bg-accent-orange bg-opacity-10 text-accent-orange rounded-pill d-inline-block px-3 py-1 mb-3 small fw-bold">
                        {{ is_numeric($year) ? "EXAM YEAR $year" : "MODEL QUESTION" }}
                    </div>
                    <h5 class="fw-bold mb-3">{{ $title }} Question Paper</h5>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="btn btn-primary-custom w-100 rounded-pill">
                            <i class="bi bi-eye me-1"></i> View Online
                        </a>
                        <a href="#" class="btn btn-outline-secondary w-100 rounded-pill">
                            <i class="bi bi-download me-1"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
