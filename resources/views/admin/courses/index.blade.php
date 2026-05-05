@extends('layouts.admin')

@section('title', 'Manage Services')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Services</li>
@endsection

@section('page_title', 'LokSewa Services (Courses)')

@section('admin_content')
    <div class="row g-4 mb-5">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue d-inline-flex p-3 rounded-circle mb-3">
                        <i class="bi bi-briefcase fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $course->title }}</h5>
                    <p class="text-muted small mb-4">{{ $course->mock_tests_count }} Mock Tests Available</p>
                    
                    <div class="d-grid">
                        <a href="{{ route('admin.tests.create', ['course_id' => $course->id]) }}" class="btn btn-primary-blue rounded-pill py-2 fw-bold">
                            <i class="bi bi-cloud-upload me-2"></i>Upload New Test
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                    <span class="extra-small fw-bold text-uppercase text-muted">Status: Active</span>
                    <a href="#" class="extra-small text-decoration-none fw-bold">Edit Details</a>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Add New Service Card --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-2 border-dashed bg-light d-flex align-items-center justify-content-center p-5 text-center">
                <button class="btn btn-soft-primary rounded-circle p-3 mb-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <i class="bi bi-plus-lg fs-4"></i>
                </button>
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
                        <h5 class="fw-bold m-0">Add New Service Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Service Title</label>
                            <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. Kharidar, Nasu, etc." required>
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
