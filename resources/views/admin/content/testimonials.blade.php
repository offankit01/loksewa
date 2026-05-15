@extends('layouts.admin')

@section('title', 'Manage Testimonials')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Testimonials</li>
@endsection

@section('page_title', 'Student Testimonials')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-5">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Student Reviews</h5>
            <button class="btn btn-primary-blue rounded-pill px-4 btn-sm" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                <i class="bi bi-plus-lg me-2"></i>Add Testimonial
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Student</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Feedback</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Rating</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Featured</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                        <tr>
                            <td class="border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-circle overflow-hidden d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        @if($testimonial->avatar)
                                            <img src="{{ Storage::url($testimonial->avatar) }}" class="w-100 h-100 object-fit-cover" alt="User">
                                        @else
                                            <i class="bi bi-person text-muted fs-5"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">{{ $testimonial->user_name }}</div>
                                        <div class="extra-small text-muted">{{ $testimonial->designation ?? 'Student' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-0 small text-muted" style="max-width: 300px;">
                                <div class="text-truncate" title="{{ $testimonial->content }}">"{{ $testimonial->content }}"</div>
                            </td>
                            <td class="border-0 text-center text-warning small">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </td>
                            <td class="border-0 text-center">
                                @if($testimonial->is_featured)
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill extra-small">Featured</span>
                                @else
                                    <span class="text-muted extra-small">-</span>
                                @endif
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-soft-primary rounded-3 p-2" data-bs-toggle="modal" data-bs-target="#editTestimonialModal{{ $testimonial->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.content.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger rounded-3 p-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Testimonial Modal -->
                        <div class="modal fade" id="editTestimonialModal{{ $testimonial->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <form action="{{ route('admin.content.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="fw-bold m-0">Edit Testimonial</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">User Name</label>
                                                    <input type="text" name="user_name" class="form-control rounded-3" value="{{ $testimonial->user_name }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Designation</label>
                                                    <input type="text" name="designation" class="form-control rounded-3" value="{{ $testimonial->designation }}" placeholder="e.g. Kharidar, Section Officer">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Testimonial Content</label>
                                                    <textarea name="content" class="form-control rounded-3" rows="4" required>{{ $testimonial->content }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Rating (1-5)</label>
                                                    <select name="rating" class="form-select rounded-3">
                                                        @for($i = 5; $i >= 1; $i--)
                                                            <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">User Avatar</label>
                                                    <input type="file" name="avatar" class="form-control rounded-3 small">
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="is_featured" id="feat{{ $testimonial->id }}" {{ $testimonial->is_featured ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-bold" for="feat{{ $testimonial->id }}">Feature on Homepage</label>
                                                    </div>
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="act{{ $testimonial->id }}" {{ $testimonial->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-bold" for="act{{ $testimonial->id }}">Active Status</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pb-4 px-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Update Testimonial</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small italic">No testimonials found yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Testimonial Modal -->
    <div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('admin.content.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="fw-bold m-0">Add New Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">User Name</label>
                                <input type="text" name="user_name" class="form-control rounded-3" placeholder="Full name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Designation</label>
                                <input type="text" name="designation" class="form-control rounded-3" placeholder="e.g. Recommended Student">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Testimonial Content</label>
                                <textarea name="content" class="form-control rounded-3" rows="4" placeholder="What did the student say?" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Rating (1-5)</label>
                                <select name="rating" class="form-select rounded-3">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">User Avatar</label>
                                <input type="file" name="avatar" class="form-control rounded-3 small">
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured">
                                    <label class="form-check-label small fw-bold" for="is_featured">Feature on Homepage</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Save Testimonial</button>
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
