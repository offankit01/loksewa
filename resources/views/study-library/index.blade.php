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
            <input type="text" id="searchInput" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search materials...">
        </div>
        <a href="{{ route('study-library.saved') }}" target="_blank" class="btn btn-light rounded-pill px-4 border">
            <i class="bi bi-bookmarks me-1"></i> Saved
        </a>
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
        <div class="material-item d-flex align-items-center justify-content-between shadow-sm material-card" data-id="{{ $loop->index }}">
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
                    <i class="bi bi-bookmark"></i>
                </button>
            </div>
        </div>
        @endforeach
        
        <div id="noSavedMessage" class="text-center py-5 d-none">
            <div class="bg-light d-inline-flex p-4 rounded-circle mb-3">
                <i class="bi bi-bookmark-x fs-1 text-muted"></i>
            </div>
            <h6 class="fw-bold">No saved items</h6>
            <p class="text-muted small">Items you bookmark will appear here.</p>
        </div>

        <div class="text-center mt-4" id="loadMoreContainer">
            <button id="loadMoreBtn" class="btn btn-outline-primary border-primary-blue text-primary-blue rounded-pill px-5">
                <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                Load More
            </button>
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

@section('extra_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const materialContainer = document.querySelector('.col-lg-8');
    const noSavedMessage = document.getElementById('noSavedMessage');
    
    let savedIds = JSON.parse(localStorage.getItem('savedMaterials') || '[]');

    // Search Logic
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.material-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = card.querySelector('h6').textContent.toLowerCase();
            if (title.includes(query)) {
                card.classList.remove('d-none');
                visibleCount++;
            } else {
                card.classList.add('d-none');
            }
        });

        if (visibleCount === 0) {
            noSavedMessage.classList.remove('d-none');
            noSavedMessage.querySelector('h6').textContent = 'No matching materials';
        } else {
            noSavedMessage.classList.add('d-none');
        }
    });

    // Load More Logic
    loadMoreBtn.addEventListener('click', function() {
        const btn = this;
        const spinner = btn.querySelector('.spinner-border');
        btn.disabled = true;
        spinner.classList.remove('d-none');
        
        setTimeout(() => {
            const extraMaterials = [
                { title: 'Current Affairs - Monthly Digest', category: 'General', type: 'PDF', date: '2 weeks ago' },
                { title: 'Public Administration Notes', category: 'Service', type: 'Note', date: '3 weeks ago' },
                { title: 'Constitutional History', category: 'History', type: 'PDF', date: '1 month ago' }
            ];

            const currentCount = document.querySelectorAll('.material-card').length;

            extraMaterials.forEach((item, index) => {
                const newId = currentCount + index;
                const isSaved = savedIds.includes(newId.toString());
                const html = `
                    <div class="material-item d-flex align-items-center justify-content-between shadow-sm material-card" data-id="${newId}">
                        <div class="d-flex align-items-center gap-4">
                            <div class="bg-light p-3 rounded-3 text-primary-blue">
                                <i class="bi bi-file-earmark-pdf fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">${item.title}</h6>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="small text-muted">${item.category}</span>
                                    <span class="vr opacity-10" style="height: 12px;"></span>
                                    <span class="small text-muted">${item.date}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="type-badge ${item.type === 'PDF' ? 'bg-danger bg-opacity-10 text-danger' : 'bg-info bg-opacity-10 text-info'}">
                                ${item.type}
                            </span>
                            <button class="btn btn-light btn-sm rounded-circle p-2">
                                <i class="bi bi-download"></i>
                            </button>
                            <button class="btn btn-light btn-sm rounded-circle p-2 bookmark-btn ${isSaved ? 'text-primary-blue' : ''}" data-id="${newId}">
                                <i class="bi bi-bookmark${isSaved ? '-fill' : ''}"></i>
                            </button>
                        </div>
                    </div>
                `;
                loadMoreContainer.insertAdjacentHTML('beforebegin', html);
            });

            btn.disabled = false;
            spinner.classList.add('d-none');
            if (document.querySelectorAll('.material-card').length > 9) btn.classList.add('d-none');
        }, 800);
    });

    // Bookmark Toggle (Event Delegation)
    materialContainer.addEventListener('click', function(e) {
        const btn = e.target.closest('.bookmark-btn');
        if (!btn) return;
        
        e.preventDefault();
        const id = btn.getAttribute('data-id');
        const icon = btn.querySelector('i');
        
        if (savedIds.includes(id)) {
            savedIds = savedIds.filter(savedId => savedId !== id);
            icon.classList.replace('bi-bookmark-fill', 'bi-bookmark');
            btn.classList.remove('text-primary-blue');
        } else {
            savedIds.push(id);
            icon.classList.replace('bi-bookmark', 'bi-bookmark-fill');
            btn.classList.add('text-primary-blue');
        }
        localStorage.setItem('savedMaterials', JSON.stringify(savedIds));
    });

    // Initial UI state
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        const id = btn.getAttribute('data-id');
        if (savedIds.includes(id)) {
            btn.querySelector('i').classList.replace('bi-bookmark', 'bi-bookmark-fill');
            btn.classList.add('text-primary-blue');
        }
    });
});
</script>
@endsection
