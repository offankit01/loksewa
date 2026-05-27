@extends('layouts.admin')

@section('title', 'Global System Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Global Settings</li>
@endsection

@section('page_title', 'System Configuration')

@section('admin_content')
    <div class="row g-4">
        {{-- Sidebar Navigation --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 sticky-top" style="top: 100px;">
                <div class="nav flex-column nav-pills" id="settingsTabs" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active d-flex align-items-center gap-3 py-3 rounded-4 mb-2" id="tab-general" data-bs-toggle="pill" data-bs-target="#content-general" type="button" role="tab">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-globe2 fs-5"></i>
                        </div>
                        <span class="fw-bold small">General Info</span>
                    </button>
                    
                    <button class="nav-link d-flex align-items-center gap-3 py-3 rounded-4 mb-2" id="tab-branding" data-bs-toggle="pill" data-bs-target="#content-branding" type="button" role="tab">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-palette fs-5"></i>
                        </div>
                        <span class="fw-bold small">Site Branding</span>
                    </button>

                    <button class="nav-link d-flex align-items-center gap-3 py-3 rounded-4 mb-2" id="tab-contact" data-bs-toggle="pill" data-bs-target="#content-contact" type="button" role="tab">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-envelope-at fs-5"></i>
                        </div>
                        <span class="fw-bold small">Contact & Support</span>
                    </button>

                    <button class="nav-link d-flex align-items-center gap-3 py-3 rounded-4 mb-2" id="tab-social" data-bs-toggle="pill" data-bs-target="#content-social" type="button" role="tab">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-share fs-5"></i>
                        </div>
                        <span class="fw-bold small">Social Presence</span>
                    </button>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <p class="extra-small text-muted mb-3"><i class="bi bi-info-circle me-1"></i> These settings affect the entire platform across all users.</p>
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="col-lg-9">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content" id="settingsContent">
                    {{-- General Info Tab --}}
                    <div class="tab-pane fade show active" id="content-general" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden mb-4">
                            <div class="card-header bg-primary-blue text-white p-4 border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-globe2 fs-2"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">General Site Info</h5>
                                        <p class="mb-0 small text-white-50">Manage site identity and meta information</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Site Name</label>
                                        <input type="text" name="site_name" class="form-control form-control-lg rounded-3 bg-light border-0" 
                                               value="{{ $settings['general']['site_name'] ?? 'LokSiksha' }}" placeholder="e.g. LokSiksha">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Site Tagline</label>
                                        <input type="text" name="site_tagline" class="form-control form-control-lg rounded-3 bg-light border-0" 
                                               value="{{ $settings['general']['site_tagline'] ?? 'Master Your LokSewa Preparation' }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small">Site Description (Meta)</label>
                                        <textarea name="site_description" class="form-control rounded-3 bg-light border-0" rows="4">{{ $settings['general']['site_description'] ?? 'The ultimate platform for LokSewa aspirants.' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Branding Tab --}}
                    <div class="tab-pane fade" id="content-branding" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden mb-4">
                            <div class="card-header bg-primary-blue text-white p-4 border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-palette fs-2"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Site Branding</h5>
                                        <p class="mb-0 small text-white-50">Upload logo and customize site visuals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-7">
                                        <label class="form-label fw-bold small">Main Site Logo</label>
                                        <div class="upload-area p-5 border-dashed rounded-4 text-center bg-light cursor-pointer" id="dropArea">
                                            <div id="uploadPlaceholder">
                                                <i class="bi bi-cloud-arrow-up display-6 text-muted mb-2 d-block"></i>
                                                <h6 class="extra-small fw-bold mb-1">Select new logo file</h6>
                                                <p class="text-muted extra-small mb-0">PNG or SVG with transparent background</p>
                                            </div>
                                            <div id="fileSelectedView" class="d-none">
                                                <img id="logoPreview" src="#" alt="Preview" class="img-fluid rounded-3 mb-2 shadow-sm" style="max-height: 100px;">
                                                <div class="extra-small text-primary-blue fw-bold text-truncate" id="fileNameDisplay">Filename.png</div>
                                                <button type="button" class="btn btn-link btn-sm text-danger text-decoration-none" onclick="resetFileUpload(event)">Remove</button>
                                            </div>
                                            <input type="file" name="site_logo" class="d-none" id="fileInput" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="p-4 border rounded-4 bg-white text-center shadow-sm">
                                            <p class="extra-small text-muted text-uppercase fw-bold mb-3">Active Logo</p>
                                            <div class="bg-light p-4 rounded-4 d-inline-block">
                                                @php
                                                    // Get the setting object directly or fallback
                                                    $logoPath = null;
                                                    foreach($settings['general'] ?? [] as $s) {
                                                        if(is_object($s) && $s->key == 'site_logo') $logoPath = $s->value;
                                                        elseif(is_array($s) && isset($s['key']) && $s['key'] == 'site_logo') $logoPath = $s['value'];
                                                    }
                                                @endphp
                                                @if($logoPath)
                                                    <img src="{{ asset('storage/' . $logoPath) }}" alt="Current Logo" style="max-height: 80px;">
                                                @else
                                                    <div class="text-muted small">No Logo Uploaded</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Tab --}}
                    <div class="tab-pane fade" id="content-contact" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden mb-4">
                            <div class="card-header bg-primary-blue text-white p-4 border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-envelope-at fs-2"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Contact & Support</h5>
                                        <p class="mb-0 small text-white-50">Manage communication channels and address</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">Support Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-envelope text-primary-blue"></i></span>
                                            <input type="email" name="contact_email" class="form-control form-control-lg border-0 bg-light rounded-end-3" 
                                                   value="{{ $settings['general']['contact_email'] ?? 'support@loksewa.com' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">Contact Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-telephone text-primary-blue"></i></span>
                                            <input type="text" name="contact_phone" class="form-control form-control-lg border-0 bg-light rounded-end-3" 
                                                   value="{{ $settings['general']['contact_phone'] ?? '+977-9800000000' }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted">Physical Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-geo-alt text-primary-blue"></i></span>
                                            <input type="text" name="address" class="form-control form-control-lg border-0 bg-light rounded-end-3" 
                                                   value="{{ $settings['general']['address'] ?? 'Kathmandu, Nepal' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Social Tab --}}
                    <div class="tab-pane fade" id="content-social" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden mb-4">
                            <div class="card-header bg-primary-blue text-white p-4 border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-share fs-2"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Social Presence</h5>
                                        <p class="mb-0 small text-white-50">Configure links to your official social handles</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted">Facebook URL</label>
                                        <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text border-0 bg-primary bg-opacity-10 px-4"><i class="bi bi-facebook fs-4 text-primary"></i></span>
                                            <input type="url" name="facebook_url" class="form-control form-control-lg border-0 bg-light" 
                                                   value="{{ $settings['general']['facebook_url'] ?? 'https://facebook.com/loksewa' }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted">YouTube Channel</label>
                                        <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text border-0 bg-danger bg-opacity-10 px-4"><i class="bi bi-youtube fs-4 text-danger"></i></span>
                                            <input type="url" name="youtube_url" class="form-control form-control-lg border-0 bg-light" 
                                                   value="{{ $settings['general']['youtube_url'] ?? 'https://youtube.com/loksewa' }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted">Instagram Handle</label>
                                        <div class="input-group mb-0 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text border-0 bg-info bg-opacity-10 px-4"><i class="bi bi-instagram fs-4 text-info"></i></span>
                                            <input type="url" name="instagram_url" class="form-control form-control-lg border-0 bg-light" 
                                                   value="{{ $settings['general']['instagram_url'] ?? 'https://instagram.com/loksewa' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mb-5">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold">Discard Changes</button>
                    <button type="submit" class="btn btn-primary-blue rounded-pill px-5 py-3 fw-bold shadow-lg">
                        <i class="bi bi-check2-circle me-2"></i>Apply Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .nav-pills .nav-link {
        color: #475569;
        transition: all 0.3s ease;
        text-align: left;
        border: 1px solid transparent;
    }
    .nav-pills .nav-link.active {
        background-color: #f8f9ff !important;
        color: var(--primary-blue) !important;
        border-color: rgba(30, 58, 138, 0.1);
    }
    .nav-pills .nav-link:hover:not(.active) {
        background-color: #f1f5f9;
    }
    .border-dashed { border: 2px dashed #dee2e6 !important; }
    .upload-area { transition: all 0.3s ease; }
    .upload-area:hover { border-color: var(--primary-blue) !important; background: #f8f9ff !important; }
    
    .input-group-text { border-right: none; border: 1px solid #dee2e6; }
    .form-control:focus, .input-group-text:focus { border-color: var(--primary-blue); box-shadow: none; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>
@endsection

@section('extra_js')
<script>
    // Logo Preview Logic
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const dropArea = document.getElementById('dropArea');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const fileSelectedView = document.getElementById('fileSelectedView');
    const logoPreview = document.getElementById('logoPreview');

    dropArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            fileNameDisplay.textContent = file.name;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
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
