@extends('layouts.admin')

@section('title', 'Manage Services')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small fw-bold" aria-current="page">Services</li>
@endsection

@section('page_title')
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3">
            <i class="bi bi-briefcase-fill fs-4"></i>
        </div>
        <div>
            <h4 class="fw-bold mb-0">Lok Siksha Services</h4>
            <p class="text-muted small mb-0">Manage and organize exam preparation categories</p>
        </div>
    </div>
@endsection

@section('admin_content')
    @php
        $categories = [
            'Nepal Administrative Service (नेपाल प्रशासन सेवा)',
            'Nepal Police Service (नेपाल प्रहरी सेवा)',
            'Nepal Army Service (नेपाली सेना सेवा)',
            'Nepal Judicial Service (नेपाल न्याय सेवा)',
            'Nepal Foreign Affairs Service (नेपाल परराष्ट्र सेवा)',
            'Nepal Audit Service (नेपाल लेखापरीक्षण सेवा)',
            'Nepal Parliamentary Service (नेपाल संसदीय सेवा)',
            'Technical Services (प्राविधिक सेवाहरू)'
        ];

        $groupedCourses = $courses->groupBy(function($course) {
            return $course->category ?? 'Uncategorized';
        });
        
        // Ensure categories appear in the specified order
        $orderedGroupedCourses = collect();
        foreach($categories as $cat) {
            if($groupedCourses->has($cat)) {
                $orderedGroupedCourses->put($cat, $groupedCourses->get($cat));
            }
        }
        // Add uncategorized at the end if any
        if($groupedCourses->has('Uncategorized')) {
            $orderedGroupedCourses->put('Uncategorized', $groupedCourses->get('Uncategorized'));
        }
        // Add any other categories that might exist but aren't in our list
        foreach($groupedCourses as $cat => $items) {
            if(!$orderedGroupedCourses->has($cat)) {
                $orderedGroupedCourses->put($cat, $items);
            }
        }
    @endphp

    {{-- Premium Statistics Bar --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="premium-stat-card card border-0 shadow-sm rounded-4 p-4 h-100" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                        <i class="bi bi-grid-fill text-primary-blue fs-4"></i>
                    </div>
                    <span class="badge bg-white text-primary-blue rounded-pill px-3 py-2 fw-bold shadow-sm" style="font-size: 0.75rem;">TOTAL</span>
                </div>
                <h3 class="fw-bold text-white mb-1" style="font-size: 2rem;">{{ $courses->count() }}</h3>
                <p class="text-white text-opacity-75 small mb-0 fw-bold text-uppercase letter-spacing-1">Active Services</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="premium-stat-card card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Live</span>
                </div>
                <h3 class="fw-bold text-dark mb-1">{{ $courses->where('is_active', true)->count() }}</h3>
                <p class="text-muted small mb-0 fw-medium">Published Categories</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="premium-stat-card card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Tests</span>
                </div>
                <h3 class="fw-bold text-dark mb-1">{{ $courses->sum('mock_tests_count') }}</h3>
                <p class="text-muted small mb-0 fw-medium">Total Mock Tests</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="premium-stat-card card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-primary-blue border-opacity-10 cursor-pointer hover-shadow" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-primary-blue bg-opacity-10 text-primary-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-plus-lg fs-4"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-primary-blue mb-1">Create New</h5>
                <p class="text-muted small mb-0 fw-medium">Add Service Category</p>
            </div>
        </div>
    </div>

    {{-- Services List Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Service Categories</h5>
        <div class="d-flex gap-2">
            <div class="input-group input-group-sm" style="width: 250px;">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill px-3"><i class="bi bi-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 rounded-end-pill ps-0" placeholder="Search services...">
            </div>
            <button class="btn btn-primary-blue btn-sm rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="bi bi-plus-lg me-1"></i> Add Service
            </button>
        </div>
    </div>

    {{-- Services Grid --}}
    @foreach($orderedGroupedCourses as $categoryName => $coursesInCategory)
        <div class="category-section mb-5">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="h-divider flex-grow-1" style="height: 2px; background: linear-gradient(90deg, transparent, #e2e8f0);"></div>
                <h6 class="fw-bold text-uppercase text-muted mb-0 letter-spacing-1 bg-light px-3 py-2 rounded-3">
                    <i class="bi bi-folder2-open me-2"></i> {{ $categoryName }}
                </h6>
                <div class="h-divider flex-grow-1" style="height: 2px; background: linear-gradient(90deg, #e2e8f0, transparent);"></div>
            </div>

            <div class="row g-4">
                @foreach($coursesInCategory as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="service-premium-card card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="service-icon-wrapper p-3 rounded-4 bg-primary-blue bg-opacity-10 text-primary-blue d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                    <i class="bi {{ $course->icon ?? 'bi-briefcase' }} fs-2"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle p-2" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                        <li>
                                            <button class="dropdown-item rounded-3 py-2 small fw-medium" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course->id }}">
                                                <i class="bi bi-pencil-square me-2 text-primary"></i> Edit Details
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.courses.toggle-status', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item rounded-3 py-2 small fw-medium">
                                                    <i class="bi {{ $course->is_active ? 'bi-eye-slash' : 'bi-eye' }} me-2 text-warning"></i> 
                                                    {{ $course->is_active ? 'Set Inactive' : 'Set Active' }}
                                                </button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider mx-2"></li>
                                        <li>
                                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item rounded-3 py-2 small fw-medium text-danger">
                                                    <i class="bi bi-trash me-2"></i> Delete Service
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <h5 class="fw-bold mb-0 text-dark">{{ $course->title }}</h5>
                                    @if($course->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill extra-small">Active</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill extra-small">Inactive</span>
                                    @endif
                                </div>
                                <p class="text-muted small line-clamp-2 mb-0">{{ $course->description ?? 'Comprehensive preparation materials and mock tests for ' . $course->title . '.' }}</p>
                            </div>

                            <div class="stats-mini-bar d-flex gap-3 mb-4 p-3 bg-light rounded-4">
                                <div class="flex-fill text-center border-end">
                                    <div class="fw-bold text-dark fs-5">{{ $course->mock_tests_count }}</div>
                                    <div class="extra-small text-muted text-uppercase fw-bold">Tests</div>
                                </div>
                                <div class="flex-fill text-center border-end">
                                    <div class="fw-bold text-dark fs-5">{{ $course->study_materials_count ?? 0 }}</div>
                                    <div class="extra-small text-muted text-uppercase fw-bold">Notes</div>
                                </div>
                                <div class="flex-fill text-center">
                                    <div class="fw-bold text-dark fs-5">{{ $course->students_count ?? 0 }}</div>
                                    <div class="extra-small text-muted text-uppercase fw-bold">Users</div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.tests.create', ['course_id' => $course->id]) }}" class="btn btn-primary-blue rounded-pill py-2 flex-grow-1 fw-bold small">
                                    <i class="bi bi-plus-lg me-1"></i> Add Test
                                </a>
                                <a href="{{ route('admin.tests.index', ['course_id' => $course->id]) }}" class="btn btn-light rounded-pill py-2 px-3">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Course Modal -->
                <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
                            <div class="modal-header bg-light border-0 py-4 px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </div>
                                    <h5 class="fw-bold m-0">Edit Service Details</h5>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.courses.update', $course) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body p-4">
                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Service Title</label>
                                        <input type="text" name="title" class="form-control form-control-custom rounded-4 p-3" value="{{ $course->title }}" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Service Category</label>
                                        <select name="category" class="form-select form-control-custom rounded-4 p-3">
                                            <option value="">Uncategorized</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat }}" {{ $course->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Description</label>
                                        <textarea name="description" class="form-control form-control-custom rounded-4 p-3" rows="3">{{ $course->description }}</textarea>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Select Identity Icon</label>
                                        <div class="icon-selector-grid d-flex flex-wrap gap-2">
                                            @php
                                                $icons = ['bi-briefcase', 'bi-shield-shaded', 'bi-shield-fill-check', 'bi-balance-scale', 'bi-globe-asia-australia', 'bi-calculator', 'bi-building', 'bi-tools', 'bi-book', 'bi-mortarboard'];
                                            @endphp
                                            @foreach($icons as $icon)
                                            <div class="icon-option">
                                                <input type="radio" class="btn-check" name="icon" id="icon_{{ $course->id }}_{{ $icon }}" value="{{ $icon }}" {{ ($course->icon ?? 'bi-briefcase') == $icon ? 'checked' : '' }}>
                                                <label class="btn btn-outline-light text-dark p-3 rounded-4 shadow-sm border" for="icon_{{ $course->id }}_{{ $icon }}">
                                                    <i class="bi {{ $icon }} fs-4"></i>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 p-4 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Discard</button>
                                    <button type="submit" class="btn btn-primary-blue rounded-pill px-5 fw-bold shadow-sm">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Add New Service Card Placeholder --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-2 border-dashed bg-light bg-opacity-50 d-flex align-items-center justify-content-center p-5 text-center cursor-pointer hover-bg-white transition-all" 
                 data-bs-toggle="modal" data-bs-target="#addServiceModal" style="border-color: #cbd5e1 !important; min-height: 250px;">
                <div class="bg-white shadow-sm rounded-circle p-4 mb-3 text-primary-blue transition-all add-icon-circle">
                    <i class="bi bi-plus-lg fs-2"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Create New Service</h6>
                    <p class="text-muted small mb-0">Expand your exam catalog</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="modal-header bg-light border-0 py-4 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3">
                            <i class="bi bi-plus-circle-fill fs-5"></i>
                        </div>
                        <h5 class="fw-bold m-0">Add New Service</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.courses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Service Title</label>
                            <input type="text" name="title" class="form-control form-control-custom rounded-4 p-3" placeholder="e.g. Kharidar, Nasu, Section Officer" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Service Category</label>
                            <select name="category" class="form-select form-control-custom rounded-4 p-3">
                                <option value="">Uncategorized</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Description</label>
                            <textarea name="description" class="form-control form-control-custom rounded-4 p-3" rows="3" placeholder="Briefly describe this service category..."></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold text-uppercase text-muted letter-spacing-1">Select Identity Icon</label>
                            <div class="icon-selector-grid d-flex flex-wrap gap-2">
                                @php
                                    $icons = ['bi-briefcase', 'bi-shield-shaded', 'bi-shield-fill-check', 'bi-balance-scale', 'bi-globe-asia-australia', 'bi-calculator', 'bi-building', 'bi-tools', 'bi-book', 'bi-mortarboard'];
                                @endphp
                                @foreach($icons as $icon)
                                <div class="icon-option">
                                    <input type="radio" class="btn-check" name="icon" id="add_icon_{{ $icon }}" value="{{ $icon }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="btn btn-outline-light text-dark p-3 rounded-4 shadow-sm border" for="add_icon_{{ $icon }}">
                                        <i class="bi {{ $icon }} fs-4"></i>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-blue rounded-pill px-5 fw-bold shadow-sm">Create Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .letter-spacing-1 { letter-spacing: 0.05em; }
    .cursor-pointer { cursor: pointer; }
    .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    
    .premium-stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .premium-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }

    .service-premium-card {
        background: white;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .service-premium-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(30, 58, 138, 0.08) !important;
    }
    .service-premium-card:hover .service-icon-wrapper {
        background-color: var(--primary-blue) !important;
        color: white !important;
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    .form-control-custom {
        background-color: #f8fafc;
        border: 2px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        background-color: white;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
    }

    .icon-option label {
        transition: all 0.2s ease;
        border: 2px solid transparent !important;
    }
    .icon-option .btn-check:checked + label {
        background-color: var(--primary-blue) !important;
        color: white !important;
        border-color: var(--primary-blue) !important;
        transform: scale(1.1);
    }
    .icon-option label:hover {
        background-color: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
    }

    .add-icon-circle {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hover-bg-white:hover .add-icon-circle {
        background-color: var(--primary-blue) !important;
        color: white !important;
        transform: rotate(90deg);
    }

    .extra-small { font-size: 0.7rem; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }

    .dropdown-menu {
        animation: dropdownFadeIn 0.2s ease-out;
    }
    @keyframes dropdownFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
