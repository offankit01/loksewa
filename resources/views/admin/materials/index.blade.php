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
            <button class="btn btn-primary-blue rounded-pill px-4">
                <i class="bi bi-cloud-upload me-2"></i> Upload PDF
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Material Title</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Category</th>
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
                                    <div class="fw-bold">{{ $material->title }}</div>
                                </div>
                            </td>
                            <td class="border-0 text-muted">{{ $material->category }}</td>
                            <td class="border-0 text-center fw-bold">{{ number_format($material->downloads) }}</td>
                            <td class="border-0 text-center small text-muted">{{ $material->created_at->format('Y-m-d') }}</td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    {{-- Generate Mock Test Dropdown --}}
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-soft-primary rounded-pill px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-robot me-1"></i> Generate Test
                                        </button>
                                        <ul class="dropdown-menu border-0 shadow-sm rounded-3">
                                            <li><h6 class="dropdown-header extra-small text-uppercase">Select Difficulty</h6></li>
                                            <li>
                                                <form action="{{ route('admin.materials.generate-test', $material) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="difficulty" value="easy">
                                                    <button type="submit" class="dropdown-item small py-2"><i class="bi bi-reception-1 text-success me-2"></i>Easy Level</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.materials.generate-test', $material) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="difficulty" value="medium">
                                                    <button type="submit" class="dropdown-item small py-2"><i class="bi bi-reception-2 text-warning me-2"></i>Medium Level</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.materials.generate-test', $material) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="difficulty" value="hard">
                                                    <button type="submit" class="dropdown-item small py-2"><i class="bi bi-reception-4 text-danger me-2"></i>Hard Level</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <button class="btn btn-sm btn-light p-2 rounded-3"><i class="bi bi-trash text-danger"></i></button>
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
