@extends('layouts.admin')

@section('title', 'Global System Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Global Settings</li>
@endsection

@section('page_title', 'System Configuration')

@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Site Branding --}}
                <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-palette me-2 text-primary-blue"></i>Site Branding</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Site Logo</label>
                                <input type="file" name="site_logo" class="form-control rounded-3" accept="image/*">
                                <p class="extra-small text-muted mt-2">Recommended: PNG or SVG with transparent background.</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="p-3 border rounded-4 bg-light d-inline-block">
                                    @if(isset($site_settings['site_logo']))
                                        <img src="{{ asset('storage/' . $site_settings['site_logo']) }}" alt="Current Logo" style="max-height: 60px;">
                                    @else
                                        <div class="text-muted small">No Logo Uploaded</div>
                                    @endif
                                </div>
                                <div class="small text-muted mt-2">Current Logo Preview</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Site Configuration --}}
                <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-globe2 me-2 text-primary-blue"></i>General Site Info</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Site Name</label>
                                <input type="text" name="site_name" class="form-control rounded-3" value="{{ $settings['general']['site_name'] ?? 'LokSewa Tayari' }}" placeholder="e.g. LokSewa Tayari">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Site Tagline</label>
                                <input type="text" name="site_tagline" class="form-control rounded-3" value="{{ $settings['general']['site_tagline'] ?? 'Master Your LokSewa Preparation' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Site Description</label>
                                <textarea name="site_description" class="form-control rounded-3" rows="3">{{ $settings['general']['site_description'] ?? 'The ultimate platform for LokSewa aspirants.' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Information --}}
                <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-envelope-at me-2 text-primary-blue"></i>Contact & Support</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Support Email</label>
                                <input type="email" name="contact_email" class="form-control rounded-3" value="{{ $settings['general']['contact_email'] ?? 'support@loksewa.com' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control rounded-3" value="{{ $settings['general']['contact_phone'] ?? '+977-9800000000' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Physical Address</label>
                                <input type="text" name="address" class="form-control rounded-3" value="{{ $settings['general']['address'] ?? 'Kathmandu, Nepal' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-share me-2 text-primary-blue"></i>Social Presence</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Facebook URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-facebook text-primary"></i></span>
                                    <input type="url" name="facebook_url" class="form-control border-start-0 rounded-end-3" value="{{ $settings['general']['facebook_url'] ?? 'https://facebook.com/loksewa' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">YouTube Channel</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-youtube text-danger"></i></span>
                                    <input type="url" name="youtube_url" class="form-control border-start-0 rounded-end-3" value="{{ $settings['general']['youtube_url'] ?? 'https://youtube.com/loksewa' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Instagram Handle</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-instagram text-primary-blue"></i></span>
                                    <input type="url" name="instagram_url" class="form-control border-start-0 rounded-end-3" value="{{ $settings['general']['instagram_url'] ?? 'https://instagram.com/loksewa' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mb-5">
                    <button type="submit" class="btn btn-primary-blue rounded-pill px-5 py-3 fw-bold shadow">
                        <i class="bi bi-cloud-arrow-up-fill me-2"></i>Save Global Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .input-group-text { border: 1px solid #dee2e6; }
    .form-control:focus, .input-group-text:focus {
        border-color: var(--primary-blue);
        box-shadow: none;
    }
</style>
@endsection
