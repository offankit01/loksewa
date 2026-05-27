@extends('layouts.admin')

@section('title', 'Create Blog Post')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.content.blogs') }}" class="text-decoration-none small text-muted">Blogs</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Create</li>
@endsection

@section('page_title', 'Create New Blog Post')

@section('admin_content')
    <form action="{{ route('admin.content.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            {{-- Main Content Column --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                    <div class="card-header bg-primary-blue text-white p-4 border-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-journal-plus fs-2"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Post Content</h5>
                                <p class="mb-0 small text-white-50">Draft your blog post with rich text and images</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Blog Title</label>
                            <input type="text" name="title" id="blogTitle" class="form-control form-control-lg rounded-3 bg-light border-0 @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" placeholder="e.g. How to prepare for Kharidar Exam 2081" required>
                            <div class="extra-small text-muted mt-2">
                                <i class="bi bi-link-45deg"></i> Permalinks: <span id="slugPreview" class="text-primary-blue fw-bold">/kharidar-prep-2081</span>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold small">Content Body</label>
                            <textarea name="content" id="blogEditor" class="form-control rounded-3 border-0 bg-light p-4" rows="15" 
                                      placeholder="Start writing your amazing story..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger extra-small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Column --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    {{-- Status Card --}}
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4">
                        <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                            <i class="bi bi-send-fill text-primary-blue"></i> Publish Options
                        </h6>
                        
                        <div class="p-3 rounded-4 border mb-4">
                            <div class="form-check form-switch p-0 d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-check-label fw-bold small mb-0" for="is_published">Publish Immediately</label>
                                    <p class="extra-small text-muted mb-0">Visible to all readers</p>
                                </div>
                                <input class="form-check-input fs-4 ms-0 cursor-pointer" type="checkbox" name="is_published" id="is_published" checked>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold extra-small text-uppercase text-muted">SEO Excerpt</label>
                            <textarea name="excerpt" class="form-control rounded-3 bg-light border-0 small" rows="4" 
                                      placeholder="Brief summary for social media and list views...">{{ old('excerpt') }}</textarea>
                            <div class="extra-small text-muted mt-2">Maximum 160 characters recommended.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-blue rounded-pill py-3 fw-bold shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i>Publish Post
                            </button>
                            <a href="{{ route('admin.content.blogs') }}" class="btn btn-light rounded-pill py-2 small">
                                Save as Draft
                            </a>
                        </div>
                    </div>

                    {{-- Image Card --}}
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                        <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                            <i class="bi bi-image-fill text-primary-blue"></i> Featured Image
                        </h6>
                        
                        <div class="upload-area p-4 border-dashed rounded-4 text-center bg-light cursor-pointer mb-3" id="dropArea">
                            <div id="uploadPlaceholder">
                                <i class="bi bi-cloud-arrow-up display-6 text-muted mb-2 d-block"></i>
                                <h6 class="extra-small fw-bold mb-1">Click to upload header image</h6>
                                <p class="text-muted extra-small mb-0">1200x630px (Max 2MB)</p>
                            </div>
                            <div id="fileSelectedView" class="d-none">
                                <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded-3 mb-2 shadow-sm" style="max-height: 150px;">
                                <div class="extra-small text-primary-blue fw-bold text-truncate" id="fileNameDisplay">Filename.jpg</div>
                                <button type="button" class="btn btn-link btn-sm text-danger text-decoration-none" onclick="resetFileUpload(event)">Remove</button>
                            </div>
                            <input type="file" name="image" class="d-none" id="fileInput" accept="image/*">
                        </div>
                        
                        <div class="alert alert-warning border-0 rounded-3 p-3 mb-0">
                            <div class="d-flex gap-2">
                                <i class="bi bi-info-circle-fill"></i>
                                <p class="extra-small mb-0">High-quality images help in better social media engagement.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('extra_css')
<style>
    .extra-small { font-size: 0.7rem; }
    .border-dashed { border: 2px dashed #dee2e6 !important; }
    .upload-area { transition: all 0.3s ease; }
    .upload-area:hover { border-color: var(--primary-blue) !important; background: #f0f7ff !important; }
    .cursor-pointer { cursor: pointer; }
    .transition { transition: all 0.3s ease; }
    .bg-primary-blue { background-color: #1e3a8a !important; }
    .text-primary-blue { color: #1e3a8a !important; }
    .btn-primary-blue { background-color: #1e3a8a; color: white; }
    .btn-primary-blue:hover { background-color: #1e40af; color: white; }
</style>
@endsection

@section('extra_js')
<script>
    // Slug Preview Logic
    const titleInput = document.getElementById('blogTitle');
    const slugPreview = document.getElementById('slugPreview');

    titleInput.addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        slugPreview.textContent = '/' + (slug || 'kharidar-prep-2081');
    });

    // Image Upload Logic
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const dropArea = document.getElementById('dropArea');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const fileSelectedView = document.getElementById('fileSelectedView');
    const imagePreview = document.getElementById('imagePreview');

    dropArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            fileNameDisplay.textContent = file.name;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                uploadPlaceholder.classList.add('d-none');
                fileSelectedView.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    function resetFileUpload(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadPlaceholder.classList.remove('d-none');
        fileSelectedView.classList.add('d-none');
    }

    // Drag and Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.add('border-primary'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.remove('border-primary'), false);
    });

    dropArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        fileInput.files = dt.files;
        fileInput.dispatchEvent(new Event('change'));
    }, false);
</script>
@endsection
