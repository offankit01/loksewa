@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.content.blogs') }}" class="text-decoration-none small text-muted">Blogs</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Edit</li>
@endsection

@section('page_title', 'Edit Blog Post')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <form action="{{ route('admin.content.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Blog Title</label>
                            <input type="text" name="title" class="form-control rounded-3" value="{{ $blog->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Content</label>
                            <textarea name="content" class="form-control rounded-3" rows="15" required>{{ $blog->content }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light border-0 rounded-4 p-3 mb-4">
                            <h6 class="fw-bold mb-3">Publishing Options</h6>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_published" id="is_published" {{ $blog->is_published ? 'checked' : '' }}>
                                <label class="form-check-label small" for="is_published">Published</label>
                            </div>
                            <div class="small text-muted mb-3 italic">
                                <i class="bi bi-eye me-1"></i> Current Views: {{ number_format($blog->views) }}
                            </div>
                            <hr class="text-muted opacity-25">
                            <div class="mb-3">
                                <label class="form-label fw-bold extra-small text-uppercase">Short Excerpt</label>
                                <textarea name="excerpt" class="form-control rounded-3 small" rows="4" placeholder="Brief summary for list view...">{{ $blog->excerpt }}</textarea>
                            </div>
                        </div>
                        
                        <div class="card bg-light border-0 rounded-4 p-3">
                            <h6 class="fw-bold mb-3">Featured Image</h6>
                            @if($blog->image)
                                <div class="mb-3 position-relative">
                                    <img src="{{ Storage::url($blog->image) }}" class="img-fluid rounded-3 border mb-2" alt="Featured">
                                    <div class="extra-small text-muted">Current image</div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <input type="file" name="image" class="form-control rounded-3 small" accept="image/*">
                                <div class="form-text extra-small mt-2">Upload new to replace. Max 2MB.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-4 pt-0 text-end">
                <a href="{{ route('admin.content.blogs') }}" class="btn btn-light rounded-pill px-4 me-2">Cancel</a>
                <button type="submit" class="btn btn-primary-blue rounded-pill px-5 fw-bold">Update Blog Post</button>
            </div>
        </form>
    </div>
@endsection

@section('extra_css')
<style>
    .extra-small { font-size: 0.7rem; }
    .italic { font-style: italic; }
</style>
@endsection
