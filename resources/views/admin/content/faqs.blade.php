@extends('layouts.admin')

@section('title', 'Manage FAQs')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">FAQs</li>
@endsection

@section('page_title', 'Frequently Asked Questions')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-5">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Platform FAQs</h5>
            <button class="btn btn-primary-blue rounded-pill px-4 btn-sm" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                <i class="bi bi-plus-lg me-2"></i>New FAQ
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0" style="width: 5%;">#</th>
                            <th class="text-muted small fw-medium text-uppercase border-0" style="width: 30%;">Question</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Answer</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                        <tr>
                            <td class="border-0 small text-muted">{{ $faq->order }}</td>
                            <td class="border-0 fw-bold small text-wrap text-dark">{{ $faq->question }}</td>
                            <td class="border-0 small text-muted text-wrap">{{ Str::limit($faq->answer, 100) }}</td>
                            <td class="border-0 text-center">
                                @if($faq->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill extra-small">Active</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill extra-small">Hidden</span>
                                @endif
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-soft-primary rounded-3 p-2" data-bs-toggle="modal" data-bs-target="#editFaqModal{{ $faq->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.content.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger rounded-3 p-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit FAQ Modal -->
                        <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <form action="{{ route('admin.content.faqs.update', $faq) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="fw-bold m-0">Edit FAQ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Question</label>
                                                    <input type="text" name="question" class="form-control rounded-3" value="{{ $faq->question }}" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Answer</label>
                                                    <textarea name="answer" class="form-control rounded-3" rows="5" required>{{ $faq->answer }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Display Order</label>
                                                    <input type="number" name="order" class="form-control rounded-3" value="{{ $faq->order }}">
                                                </div>
                                                <div class="col-md-6 d-flex align-items-end">
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="act{{ $faq->id }}" {{ $faq->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-bold" for="act{{ $faq->id }}">Active Status</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pb-4 px-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Update FAQ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small italic">No FAQs found. Start by adding one!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('admin.content.faqs.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="fw-bold m-0">Add New FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold">Question</label>
                                <input type="text" name="question" class="form-control rounded-3" placeholder="Enter question" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Answer</label>
                                <textarea name="answer" class="form-control rounded-3" rows="5" placeholder="Enter answer" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Display Order</label>
                                <input type="number" name="order" class="form-control rounded-3" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Save FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .extra-small { font-size: 0.7rem; }
    .btn-soft-primary { background: #eef2ff; color: #4f46e5; border: none; }
    .btn-soft-danger { background: #fef2f2; color: #dc2626; border: none; }
    .btn-soft-primary:hover { background: #4f46e5; color: white; }
    .btn-soft-danger:hover { background: #dc2626; color: white; }
</style>
@endsection
