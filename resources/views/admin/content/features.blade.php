@extends('layouts.admin')

@section('title', 'Manage Feature Cards')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Features</li>
@endsection

@section('page_title', 'Homepage Feature Cards')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-5">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">"Why Choose Us" Features</h5>
            <button class="btn btn-primary-blue rounded-pill px-4 btn-sm" data-bs-toggle="modal" data-bs-target="#addFeatureModal">
                <i class="bi bi-plus-lg me-2"></i>New Feature
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0" style="width: 5%;">#</th>
                            <th class="text-muted small fw-medium text-uppercase border-0" style="width: 20%;">Title</th>
                            <th class="text-muted small fw-medium text-uppercase border-0" style="width: 30%;">Description</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Icon & Theme</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($features as $feature)
                        <tr>
                            <td class="border-0 small text-muted">{{ $feature->order }}</td>
                            <td class="border-0 fw-bold small text-wrap text-dark">{{ $feature->title }}</td>
                            <td class="border-0 small text-muted text-wrap">{{ Str::limit($feature->description, 80) }}</td>
                            <td class="border-0">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="p-2 rounded-3 bg-{{ $feature->theme_color }} bg-opacity-10 text-{{ $feature->theme_color }}">
                                        <i class="bi {{ $feature->icon }}"></i>
                                    </div>
                                    <div class="small text-muted">{{ $feature->theme_color }}</div>
                                </div>
                            </td>
                            <td class="border-0 text-center">
                                @if($feature->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill extra-small">Active</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill extra-small">Hidden</span>
                                @endif
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-soft-primary rounded-3 p-2" data-bs-toggle="modal" data-bs-target="#editFeatureModal{{ $feature->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.content.features.destroy', $feature) }}" method="POST" onsubmit="return confirm('Delete this feature?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger rounded-3 p-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Feature Modal -->
                        <div class="modal fade" id="editFeatureModal{{ $feature->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <form action="{{ route('admin.content.features.update', $feature) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="fw-bold m-0">Edit Feature</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Title</label>
                                                    <input type="text" name="title" class="form-control rounded-3" value="{{ $feature->title }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Theme Color</label>
                                                    <select name="theme_color" class="form-select rounded-3">
                                                        <option value="primary-blue" {{ $feature->theme_color == 'primary-blue' ? 'selected' : '' }}>Primary Blue</option>
                                                        <option value="accent-orange" {{ $feature->theme_color == 'accent-orange' ? 'selected' : '' }}>Accent Orange</option>
                                                        <option value="success" {{ $feature->theme_color == 'success' ? 'selected' : '' }}>Success Green</option>
                                                        <option value="danger" {{ $feature->theme_color == 'danger' ? 'selected' : '' }}>Danger Red</option>
                                                        <option value="info" {{ $feature->theme_color == 'info' ? 'selected' : '' }}>Info Blue</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Description</label>
                                                    <textarea name="description" class="form-control rounded-3" rows="3" required>{{ $feature->description }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Bootstrap Icon Class</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-end-0"><i class="bi {{ $feature->icon }}"></i></span>
                                                        <input type="text" name="icon" class="form-control border-start-0 rounded-end-3" value="{{ $feature->icon }}" placeholder="bi-star" required>
                                                    </div>
                                                    <div class="form-text extra-small">Example: bi-person-video3</div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small fw-bold">Display Order</label>
                                                    <input type="number" name="order" class="form-control rounded-3" value="{{ $feature->order }}">
                                                </div>
                                                <div class="col-md-3 d-flex align-items-end">
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="act{{ $feature->id }}" {{ $feature->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-bold" for="act{{ $feature->id }}">Active Status</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pb-4 px-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Update Feature</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted small italic">No features found. Start by adding one!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Feature Modal -->
    <div class="modal fade" id="addFeatureModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('admin.content.features.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="fw-bold m-0">Add New Feature</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Title</label>
                                <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. Expert Mentorship" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Theme Color</label>
                                <select name="theme_color" class="form-select rounded-3">
                                    <option value="primary-blue">Primary Blue</option>
                                    <option value="accent-orange">Accent Orange</option>
                                    <option value="success">Success Green</option>
                                    <option value="danger">Danger Red</option>
                                    <option value="info">Info Blue</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Enter short description" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Bootstrap Icon Class</label>
                                <input type="text" name="icon" class="form-control rounded-3" placeholder="e.g. bi-person-video3" value="bi-star" required>
                                <div class="form-text extra-small">Find icons at <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Display Order</label>
                                <input type="number" name="order" class="form-control rounded-3" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Save Feature</button>
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
