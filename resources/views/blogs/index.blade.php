@extends('layouts.main')

@section('title', 'Our Blog - LokSewa Tayari')

@section('content')
    <div class="py-5 bg-light">
        <div class="container py-5 text-center">
            <h1 class="fw-bold mb-3">Preparation Guides & News</h1>
            <p class="lead text-muted mx-auto" style="max-width: 800px;">Explore our latest articles, strategies, and news updates to stay ahead in your LokSewa preparation.</p>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-5">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-translate">
                        <img src="{{ $blog['image'] }}" class="card-img-top" alt="Blog" style="height: 240px; object-fit: cover;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-1 rounded-pill small fw-bold">Education</span>
                                <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> {{ $blog['date'] }}</span>
                            </div>
                            <h4 class="fw-bold mb-3">{{ $blog['title'] }}</h4>
                            <p class="text-muted mb-4">{{ $blog['excerpt'] }}</p>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary-blue" style="width: 32px; height: 32px; font-size: 0.8rem;">A</div>
                                    <span class="small fw-bold text-dark">{{ $blog['author'] }}</span>
                                </div>
                                <a href="#" class="btn btn-link text-primary-blue fw-bold text-decoration-none p-0">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5 pt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center gap-2">
                        <li class="page-item disabled"><a class="page-link rounded-3 border-0 bg-light" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link rounded-3 border-0" href="#">1</a></li>
                        <li class="page-item"><a class="page-link rounded-3 border-0 bg-light text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded-3 border-0 bg-light text-dark" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
