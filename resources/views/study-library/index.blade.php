@extends('layouts.dashboard')

@section('title', 'Study Library')

@section('extra_css')
<style>
    .category-card {
        background: white;
        border-radius: 1.25rem;
        padding: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
    }
    .category-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary-blue);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
    .category-icon {
        width: 64px;
        height: 64px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1.5rem;
        background: rgba(30, 58, 138, 0.05);
        color: var(--primary-blue);
        transition: all 0.3s ease;
    }
    .category-card:hover .category-icon {
        background: var(--primary-blue);
        color: white;
    }
    .material-item {
        background: white;
        border-radius: 1rem;
        padding: 1rem 1.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 1rem;
        transition: all 0.2s;
    }
    .material-item:hover {
        background: #f8f9fa;
    }
    .type-badge {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        padding: 4px 8px;
        border-radius: 6px;
    }
</style>
@endsection

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h3 class="fw-bold mb-1">Study Library</h3>
        <p class="text-muted small mb-0">Explore expert-curated notes and preparation materials</p>
    </div>
    <div class="d-flex gap-3">
        <div class="input-group" style="width: 300px;">
            <span class="input-group-text bg-white border-end-0 text-muted">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search materials...">
        </div>
        <button class="btn btn-light rounded-pill px-4">
            <i class="bi bi-bookmarks me-1"></i> Saved
        </button>
    </div>
</div>

<h5 class="fw-bold mb-4">Browse by Category</h5>
<div class="row g-4 mb-5">
    @foreach($categories as $category)
    <div class="col-md-4 col-xl-2 col-6">
        <a href="#" class="text-decoration-none">
            <div class="category-card shadow-sm">
                <div class="category-icon">
                    <i class="bi {{ $category['icon'] }}"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">{{ $category['name'] }}</h6>
                <p class="text-muted small mb-0">{{ $category['count'] }} items</p>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="row g-4">
    <!-- Recent Materials -->
    <div class="col-lg-8">
        <h5 class="fw-bold mb-4">Recently Added</h5>
        @foreach($recentMaterials as $material)
        <div class="material-item d-flex align-items-center justify-content-between shadow-sm">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-light p-3 rounded-3 text-primary-blue">
                    <i class="bi bi-file-earmark-pdf fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-dark">{{ $material['title'] }}</h6>
                    <div class="d-flex align-items-center gap-3">
                        <span class="small text-muted">{{ $material['category'] }}</span>
                        <span class="vr opacity-10" style="height: 12px;"></span>
                        <span class="small text-muted">{{ $material['date'] }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="type-badge {{ $material['type'] == 'PDF' ? 'bg-danger bg-opacity-10 text-danger' : 'bg-info bg-opacity-10 text-info' }}">
                    {{ $material['type'] }}
                </span>
                <button class="btn btn-light btn-sm rounded-circle p-2">
                    <i class="bi bi-download"></i>
                </button>
                <button class="btn btn-light btn-sm rounded-circle p-2">
                    <i class="bi bi-bookmark"></i>
                </button>
            </div>
        </div>
        @endforeach
        
        <div class="text-center mt-4">
            <button class="btn btn-outline-primary border-primary-blue text-primary-blue rounded-pill px-5">Load More</button>
        </div>
    </div>

    <!-- Quick Links / Stats -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h6 class="fw-bold mb-3">Library Stats</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Total Materials</span>
                    <span class="fw-bold">1,240</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Downloaded</span>
                    <span class="fw-bold text-success">45</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Available Space</span>
                    <span class="fw-bold">Unlimited</span>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary-blue text-white">
            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-lightning-charge-fill fs-3 text-accent-orange"></i>
                <h6 class="fw-bold mb-0">Premium Access</h6>
            </div>
            <p class="small text-white-50 mb-4">Upgrade to Premium to access exclusive Question Banks and Solved Papers.</p>
            <a href="{{ route('pricing') }}" class="btn btn-accent-custom w-100 rounded-pill fw-bold">Upgrade Now</a>
        </div>
    </div>
</div>
@endsection
