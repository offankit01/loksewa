@extends('layouts.admin')

@section('title', 'Manage Services')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Services</li>
@endsection

@section('page_title', 'LokSewa Services (Courses)')

@section('admin_content')
    {{-- Statistics Row --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-primary-blue text-white p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-grid-fill fs-2"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ $courses->count() }}</h4>
                        <p class="mb-0 extra-small text-white-50 text-uppercase fw-bold">Total Services</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-check-circle-fill fs-2"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ $courses->where('is_active', true)->count() }}</h4>
                        <p class="mb-0 extra-small text-muted text-uppercase fw-bold">Active Now</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-journal-bookmark-fill fs-2"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ $courses->sum('mock_tests_count') }}</h4>
                        <p class="mb-0 extra-small text-muted text-uppercase fw-bold">Total Tests</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 cursor-pointer hover-shadow transition-all" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-plus-lg fs-2"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-primary-blue">Add New</h6>
                        <p class="mb-0 extra-small text-muted text-uppercase fw-bold">Create Service</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-shadow transition-all bg-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue d-flex align-items-center justify-content-center rounded-4" style="width: 60px; height: 60px;">
                            <i class="bi {{ $course->icon ?? 'bi-briefcase' }} fs-2"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle p-2" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-2">
                                <li>
                                    <button class="dropdown-item rounded-2 py-2 small" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course->id }}">
                                        <i class="bi bi-pencil-square me-2 text-primary"></i> Edit Details
                                    </button>
                                </li>
                                <li>
                                    <form action="{{ route('admin.courses.toggle-status', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded-2 py-2 small">
                                            <i class="bi {{ $course->is_active ? 'bi-eye-slash' : 'bi-eye' }} me-2 text-warning"></i> 
                                            {{ $course->is_active ? 'Set Inactive' : 'Set Active' }}
                                        </button>
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item rounded-2 py-2 small text-danger">
                                            <i class="bi bi-trash me-2"></i> Delete Service
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-2 text-dark">{{ $course->title }}</h5>
                    <p class="text-muted small mb-4 line-clamp-2" style="min-height: 40px;">{{ $course->description ?? 'Comprehensive preparation materials and mock tests for ' . $course->title . '.' }}</p>
                    
                    <div class="bg-light rounded-4 p-3 mb-4 d-flex justify-content-around text-center">
                        <div>
                            <div class="fw-bold text-dark">{{ $course->mock_tests_count }}</div>
                            <div class="extra-small text-muted text-uppercase fw-bold">Tests</div>
                        </div>
                        <div class="border-start"></div>
                        <div>
                            <div class="fw-bold text-dark">{{ $course->study_materials_count ?? 0 }}</div>
                            <div class="extra-small text-muted text-uppercase fw-bold">Notes</div>
                        </div>
                        <div class="border-start"></div>
                        <div>
                            <div class="fw-bold text-success">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill extra-small">Active</span>
                            </div>
                            <div class="extra-small text-muted text-uppercase fw-bold">Status</div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.tests.create', ['course_id' => $course->id]) }}" class="btn btn-primary-blue rounded-pill py-2 fw-bold small shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i>Add New Test
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Course Modal -->
        <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <form action="{{ route('admin.courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header border-0 pt-4 px-4">
                            <h5 class="fw-bold m-0">Edit Service: {{ $course->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Service Title</label>
                                <input type="text" name="title" class="form-control rounded-3" value="{{ $course->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Description (Optional)</label>
                                <textarea name="description" class="form-control rounded-3" rows="3">{{ $course->description }}</textarea>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-bold">Select Icon</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @php
                                        $icons = ['bi-briefcase', 'bi-shield-shaded', 'bi-shield-fill-check', 'bi-balance-scale', 'bi-globe-asia-australia', 'bi-calculator', 'bi-building', 'bi-tools', 'bi-book', 'bi-mortarboard'];
                                    @endphp
                                    @foreach($icons as $icon)
                                    <div class="form-check p-0">
                                        <input type="radio" class="btn-check" name="icon" id="icon_{{ $course->id }}_{{ $icon }}" value="{{ $icon }}" {{ ($course->icon ?? 'bi-briefcase') == $icon ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary p-2 rounded-3" for="icon_{{ $course->id }}_{{ $icon }}">
                                            <i class="bi {{ $icon }} fs-5"></i>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pb-4 px-4">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Update Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Add New Service Card --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-2 border-dashed bg-light d-flex align-items-center justify-content-center p-5 text-center cursor-pointer hover-bg-white transition-all" 
                 data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-circle p-3 mb-3">
                    <i class="bi bi-plus-lg fs-4"></i>
                </div>
                <h6 class="fw-bold mb-0">Add New Service</h6>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('admin.courses.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="fw-bold m-0">Create New Service Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Service Title</label>
                            <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. Kharidar, Nasu, etc." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Description (Optional)</label>
                            <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Brief details about this service..."></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Select Icon</label>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $icons = ['bi-briefcase', 'bi-shield-shaded', 'bi-shield-fill-check', 'bi-balance-scale', 'bi-globe-asia-australia', 'bi-calculator', 'bi-building', 'bi-tools', 'bi-book', 'bi-mortarboard'];
                                @endphp
                                @foreach($icons as $icon)
                                <div class="form-check p-0">
                                    <input type="radio" class="btn-check" name="icon" id="add_icon_{{ $icon }}" value="{{ $icon }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary p-2 rounded-3" for="add_icon_{{ $icon }}">
                                        <i class="bi {{ $icon }} fs-5"></i>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Create Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .btn-soft-success { background: #dcfce7; color: #15803d; }
    .btn-soft-secondary { background: #f1f5f9; color: #475569; }
    .cursor-pointer { cursor: pointer; }
    .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1) !important; }
    .hover-bg-white:hover { background: white !important; border-style: solid !important; border-color: var(--primary-blue) !important; }
    .transition-all { transition: all 0.3s ease; }
    .extra-small { font-size: 0.7rem; }
    .btn-check:checked + label { background-color: var(--primary-blue); color: white; border-color: var(--primary-blue); }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    .card-footer-transparent {
        background: transparent;
        border: none;
    }
</style>
@endsection
