@extends('layouts.admin')

@section('title', 'Manage Courses')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ url('/admin/dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Courses</li>
@endsection

@section('page_title', 'Manage Services & Courses')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Course List</h5>
            <button class="btn btn-primary-custom rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i> Add New Course
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Course Name</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Service Category</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Students</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td class="border-0">
                                <div class="fw-bold">{{ $course['name'] }}</div>
                                <div class="small text-muted">ID: #{{ str_pad($course['id'], 4, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="border-0 text-muted">{{ $course['service'] }}</td>
                            <td class="border-0 text-center fw-bold">{{ $course['students'] }}</td>
                            <td class="border-0 text-center">
                                <span class="badge {{ $course['status'] == 'Active' ? 'badge-soft-success' : 'badge-soft-warning' }}">
                                    {{ $course['status'] }}
                                </span>
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-light p-2 rounded-3"><i class="bi bi-pencil-square text-primary"></i></button>
                                    <button class="btn btn-sm btn-light p-2 rounded-3"><i class="bi bi-trash text-danger"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
