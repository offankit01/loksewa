@extends('layouts.dashboard')

@section('title', 'Saved Materials')

@section('extra_css')
<style>
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
<div class="mb-5">
    <div class="d-flex align-items-center gap-3 mb-2">
        <a href="{{ route('study-library') }}" class="btn btn-light rounded-circle p-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h3 class="fw-bold mb-0">Saved Materials</h3>
    </div>
    <p class="text-muted small ps-5">Your bookmarked study notes and PDFs</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div id="savedList">
            @foreach($recentMaterials as $material)
            <div class="material-item d-flex align-items-center justify-content-between shadow-sm material-card d-none" data-id="{{ $loop->index }}">
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
                    <button class="btn btn-light btn-sm rounded-circle p-2 bookmark-btn" data-id="{{ $loop->index }}">
                        <i class="bi bi-bookmark-fill text-primary-blue"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div id="emptyMessage" class="text-center py-5 d-none">
            <div class="bg-light d-inline-flex p-4 rounded-circle mb-3">
                <i class="bi bi-bookmark-x fs-1 text-muted"></i>
            </div>
            <h6 class="fw-bold">No saved items found</h6>
            <p class="text-muted small">Go back to the library to bookmark some materials.</p>
            <a href="{{ route('study-library') }}" class="btn btn-primary-blue rounded-pill px-4 mt-3 text-white">Browse Library</a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
            <h6 class="fw-bold mb-3">Quick Tip</h6>
            <p class="small text-muted mb-0">Saving materials helps you quickly access them later even when you are offline (if cached).</p>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const materialCards = document.querySelectorAll('.material-card');
    const bookmarkBtns = document.querySelectorAll('.bookmark-btn');
    const emptyMessage = document.getElementById('emptyMessage');
    
    let savedIds = JSON.parse(localStorage.getItem('savedMaterials') || '[]');

    function renderSaved() {
        let visibleCount = 0;
        materialCards.forEach(card => {
            const id = card.getAttribute('data-id');
            if (savedIds.includes(id)) {
                card.classList.remove('d-none');
                visibleCount++;
            } else {
                card.classList.add('d-none');
            }
        });

        if (visibleCount === 0) {
            emptyMessage.classList.remove('d-none');
        } else {
            emptyMessage.classList.add('d-none');
        }
    }

    // Initial render
    renderSaved();

    // Handle un-bookmarking from this page
    bookmarkBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            
            savedIds = savedIds.filter(savedId => savedId !== id);
            localStorage.setItem('savedMaterials', JSON.stringify(savedIds));
            
            renderSaved();
        });
    });
});
</script>
@endsection
