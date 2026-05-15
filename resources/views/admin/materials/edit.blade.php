@extends('layouts.admin')

@section('title', 'Edit Study Material')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item small"><a href="{{ route('admin.materials.index') }}" class="text-decoration-none">Materials</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Edit</li>
@endsection

@section('page_title', 'Edit Resource')

@section('admin_content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
            <div class="card-header bg-primary-blue text-white p-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                        <i class="bi bi-pencil-square fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Update Resource</h5>
                        <p class="mb-0 small text-white-50">Modify details or replace the existing file</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row g-4">
                        {{-- Resource Title --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small">Resource Title</label>
                            <input type="text" name="title" class="form-control form-control-lg rounded-3 bg-light border-0" 
                                   value="{{ old('title', $material->title) }}" placeholder="e.g. Nepal Constitution 2072 Summary" required>
                        </div>

                        {{-- Category Selection --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Target Exam / Category</label>
                            <div id="selectedCategoryDisplay" class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#serviceSelectorModal">
                                <span class="text-dark fw-bold small" id="selectedCourseName">
                                    @php
                                        $course = $courses->firstWhere('slug', $material->category);
                                    @endphp
                                    {{ $course ? $course->title : 'Select Category...' }}
                                </span>
                                <i class="bi bi-chevron-down small"></i>
                            </div>
                            <input type="hidden" name="category" id="course_slug_input" value="{{ old('category', $material->category) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Resource Type</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="type" id="type_note" value="note" {{ $material->type == 'note' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary w-100 py-2 rounded-3 border-dashed small" for="type_note">
                                        <i class="bi bi-journal-text me-2"></i>Study Note
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="type" id="type_pyq" value="pyq" {{ $material->type == 'pyq' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning w-100 py-2 rounded-3 border-dashed small" for="type_pyq">
                                        <i class="bi bi-clock-history me-2"></i>PYQ
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="type" id="type_syllabus" value="syllabus" {{ $material->type == 'syllabus' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-info w-100 py-2 rounded-3 border-dashed small" for="type_syllabus">
                                        <i class="bi bi-list-columns me-2"></i>Syllabus
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="type" id="type_model" value="model" {{ $material->type == 'model' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success w-100 py-2 rounded-3 border-dashed small" for="type_model">
                                        <i class="bi bi-file-earmark-check me-2"></i>Model Q.
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- File Upload Area --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small">Replace File (Optional)</label>
                            <div class="upload-area p-5 border-dashed rounded-4 text-center bg-light cursor-pointer" id="dropArea">
                                <i class="bi bi-file-earmark-pdf text-muted display-4 mb-3 d-block"></i>
                                <h6 class="fw-bold mb-1">Click to select or drag and drop</h6>
                                <p class="text-muted extra-small mb-3">Leave empty to keep existing file</p>
                                <input type="file" name="file" class="d-none" id="fileInput">
                                <div id="fileNameDisplay" class="badge bg-primary-blue p-2 {{ $material->file_path ? '' : 'd-none' }}">
                                    @if($material->file_path)
                                        Current: {{ basename($material->file_path) }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small">Short Description (Optional)</label>
                            <textarea name="description" class="form-control rounded-3 bg-light border-0 @error('description') is-invalid @enderror" rows="3" 
                                      placeholder="Brief summary of what this resource covers...">{{ old('description', $material->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Access Level --}}
                        <div class="col-12">
                            <div class="form-check form-switch p-3 border rounded-3 bg-light bg-opacity-50">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_premium" id="is_premium" value="1" {{ $material->is_premium ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small" for="is_premium">
                                    <i class="bi bi-star-fill text-warning me-2"></i>Mark as Premium Content
                                </label>
                                <div class="extra-small text-muted ms-5 mt-1">Premium users will have exclusive access to this resource.</div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 mt-5 d-flex gap-3">
                            <a href="{{ route('admin.materials.index') }}" class="btn btn-light rounded-pill px-5 py-3 fw-bold flex-grow-1">Cancel</a>
                            <button type="submit" class="btn btn-primary-blue rounded-pill px-5 py-3 fw-bold shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-2"></i>Update Resource
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Service Selector Modal -->
<div class="modal fade" id="serviceSelectorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold m-0" id="selectorTitle">Select Service Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="categoryStep" class="row g-4">
                    @foreach($mainCategories as $cat)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 cursor-pointer hover-shadow category-btn bg-white" 
                             onclick="showSubCategories('{{ $cat['id'] }}', '{{ $cat['name'] }} ({{ $cat['name_nep'] }})')">
                            <div class="bg-primary-blue bg-opacity-10 text-primary-blue d-inline-flex p-3 rounded-circle mb-3 mx-auto">
                                <i class="bi {{ $cat['icon'] }} fs-3"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark small">{{ $cat['name'] }}</h6>
                            <div class="extra-small text-accent-orange fw-bold">{{ $cat['name_nep'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="examStep" class="d-none">
                    <button class="btn btn-sm btn-light rounded-pill mb-4 px-3 fw-bold" onclick="backToCategories()">
                        <i class="bi bi-arrow-left me-2"></i>Back to Categories
                    </button>
                    <div class="row g-3" id="examList"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const allCourses = @json($courses);
    const categoryMapping = {
        'admin': [{ label: 'NON-GAZETTED', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] }, { label: 'GAZETTED', items: ['Section Officer (शाखा अधिकृत)'] }],
        'police': [{ label: 'POSTS', items: ['Constable (प्रहरी जवान)', 'Assistant Sub Inspector', 'Inspector'] }],
        'army': [{ label: 'POSTS', items: ['Sainik (सैनिक)', 'Second Lieutenant'] }],
        'judicial': [{ label: 'NON-GAZETTED', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] }, { label: 'GAZETTED', items: ['Section Officer (शाखा अधिकृत)', 'Judge'] }],
        'technical': [{ label: 'ENGINEERING', items: ['Sub Engineer', 'Engineer'] }, { label: 'AGRICULTURE', items: ['Junior Technical Assistant', 'Technical Assistant'] }]
    };

    function showSubCategories(catId, catName) {
        document.getElementById('selectorTitle').textContent = catName;
        document.getElementById('categoryStep').classList.add('d-none');
        document.getElementById('examStep').classList.remove('d-none');
        const list = document.getElementById('examList');
        list.innerHTML = '';
        const subGroups = categoryMapping[catId] || [];
        subGroups.forEach(group => {
            const header = document.createElement('div');
            header.className = 'col-12 mt-4';
            header.innerHTML = `<h6 class="text-primary-blue fw-bold small border-bottom pb-2 mb-3">${group.label}</h6>`;
            list.appendChild(header);
            const filtered = allCourses.filter(course => group.items.some(key => course.title.includes(key.split(' (')[0])));
            const row = document.createElement('div');
            row.className = 'row g-3 px-2';
            filtered.forEach(course => {
                const col = document.createElement('div');
                col.className = 'col-md-6';
                col.innerHTML = `<div class="card border rounded-3 p-3 cursor-pointer hover-shadow bg-white" onclick="selectCourse('${course.slug}', '${course.title}')">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="fw-bold small text-truncate">${course.title}</span>
                        <i class="bi bi-plus-circle text-primary-blue small"></i>
                    </div>
                </div>`;
                row.appendChild(col);
            });
            list.appendChild(row);
        });
    }

    function backToCategories() {
        document.getElementById('selectorTitle').textContent = 'Select Service Category';
        document.getElementById('examStep').classList.add('d-none');
        document.getElementById('categoryStep').classList.remove('d-none');
    }

    function selectCourse(slug, title) {
        document.getElementById('course_slug_input').value = slug;
        document.getElementById('selectedCourseName').textContent = title;
        bootstrap.Modal.getInstance(document.getElementById('serviceSelectorModal')).hide();
    }

    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    document.getElementById('dropArea').addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileNameDisplay.textContent = 'New File: ' + this.files[0].name;
            fileNameDisplay.classList.remove('d-none');
        }
    });
</script>

@section('extra_css')
<style>
    .border-dashed { border: 2px dashed #dee2e6 !important; }
    .upload-area:hover { border-color: var(--primary-blue) !important; background: #f8f9ff !important; }
    .cursor-pointer { cursor: pointer; }
    .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1) !important; }
</style>
@endsection
