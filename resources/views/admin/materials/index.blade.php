@extends('layouts.admin')

@section('title', 'Study Materials')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Materials</li>
@endsection

@section('page_title', 'Study Materials Library')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">PDF & Note Management</h5>
            <a href="{{ route('admin.materials.create') }}" class="btn btn-primary-blue rounded-pill px-4">
                <i class="bi bi-cloud-upload me-2"></i> Upload Resource
            </a>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Material Title</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Category</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Type</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Downloads</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Uploaded On</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $material)
                        <tr>
                            <td class="border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-3">
                                        <i class="bi bi-file-earmark-pdf fs-5"></i>
                                    </div>
                                    <div class="fw-bold text-dark">{{ $material->title }}</div>
                                </div>
                            </td>
                            <td class="border-0">
                                <div class="fw-bold small">{{ $material->course->title ?? 'General' }}</div>
                                <div class="extra-small text-muted text-uppercase">{{ $material->category }}</div>
                            </td>
                            <td class="border-0 text-center">
                                @if($material->type == 'note')
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill border border-primary border-opacity-10 small">Study Note</span>
                                @elseif($material->type == 'pyq')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill border border-warning border-opacity-10 small">PYQ</span>
                                @elseif($material->type == 'syllabus')
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 rounded-pill border border-info border-opacity-10 small">Syllabus</span>
                                @elseif($material->type == 'model')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill border border-success border-opacity-10 small">Model Q.</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill border border-secondary border-opacity-10 small">{{ ucfirst($material->type) }}</span>
                                @endif
                            </td>
                            <td class="border-0 text-center fw-bold">{{ number_format($material->downloads) }}</td>
                            <td class="border-0 text-center small text-muted">{{ $material->created_at->format('Y-m-d') }}</td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.materials.edit', $material->id) }}" class="btn btn-sm btn-light p-2 rounded-3" title="Edit">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light p-2 rounded-3" title="Delete">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No materials found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
