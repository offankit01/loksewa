@extends('layouts.admin')

@section('title', 'Manage Mock Tests')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Mock Tests</li>
@endsection

@section('page_title', 'Mock Test Library')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Exam Management</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.materials.index') }}" class="btn btn-soft-primary rounded-pill px-4 btn-sm">
                    <i class="bi bi-robot me-2"></i>Generate AI Test
                </a>
                <a href="{{ route('admin.tests.create') }}" class="btn btn-primary-blue rounded-pill px-4 btn-sm">
                    <i class="bi bi-plus-lg me-2"></i>Manual Test
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Test Details</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Questions</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Difficulty</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Source</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $test)
                        <tr>
                            <td class="border-0">
                                <div class="fw-bold">{{ $test->title }}</div>
                                <div class="extra-small text-muted">Time: {{ $test->time_limit }} mins</div>
                            </td>
                            <td class="border-0 text-center fw-bold">{{ $test->questions_count }}</td>
                            <td class="border-0 text-center">
                                @if($test->difficulty == 'easy')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Easy</span>
                                @elseif($test->difficulty == 'medium')
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Medium</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Hard</span>
                                @endif
                            </td>
                            <td class="border-0 text-center small">
                                @if($test->is_ai_generated)
                                    <span class="text-primary-blue fw-bold"><i class="bi bi-robot me-1"></i>AI Generated</span>
                                @else
                                    <span class="text-muted">Manual</span>
                                @endif
                            </td>
                            <td class="border-0 text-end">
                                <form action="{{ route('admin.tests.toggle-publish', $test) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $test->is_published ? 'btn-soft-success' : 'btn-soft-secondary' }} rounded-pill px-3 fw-bold">
                                        {{ $test->is_published ? 'Published' : 'Draft' }}
                                    </button>
                                </form>
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-light p-2 rounded-3"><i class="bi bi-pencil text-primary"></i></button>
                                    <form action="{{ route('admin.tests.destroy', $test) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light p-2 rounded-3"><i class="bi bi-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No mock tests found. Generate one from study materials!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $tests->links() }}
            </div>
        </div>
    </div>
@endsection
