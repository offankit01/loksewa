@extends('layouts.admin')

@section('title', 'Upload Study Material')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item small"><a href="{{ route('admin.materials.index') }}" class="text-decoration-none">Materials</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Upload</li>
@endsection

@section('page_title', 'Upload Note or PYQ')

@section('admin_content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
            <div class="card-header bg-primary-blue text-white p-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-cloud-arrow-up fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">New Resource Upload</h5>
                        <p class="mb-0 small text-white-50">Upload PDFs, Notes, and Previous Year Questions (PYQs)</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Section 1: Basic Information --}}
                    <div class="p-4 p-md-5 border-bottom">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="bg-primary-blue text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 24px; height: 24px; font-size: 12px;">1</span>
                            <h6 class="fw-bold mb-0 text-primary-blue">Basic Information</h6>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold small">Resource Title</label>
                                <input type="text" name="title" id="materialTitle" class="form-control form-control-lg rounded-3 bg-light border-0 @error('title') is-invalid @enderror" 
                                       value="{{ old('title') }}" placeholder="e.g. Nepal Constitution 2072 Summary" required>
                                <div class="extra-small text-muted mt-1">Slug: <span id="slugPreview" class="text-primary-blue">/resource-title</span></div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Target Exam / Category</label>
                                <div id="selectedCategoryDisplay" class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center cursor-pointer hover-shadow transition" data-bs-toggle="modal" data-bs-target="#serviceSelectorModal">
                                    <span class="text-muted small" id="selectedCourseName">Select Category...</span>
                                    <i class="bi bi-chevron-down small"></i>
                                </div>
                                <input type="hidden" name="course_id" id="course_id_input" value="{{ old('course_id') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Resource Type</label>
                                <div class="row g-2">
                                    @foreach(['note' => ['Study Note', 'bi-journal-text', 'primary'], 'pyq' => ['PYQ', 'bi-clock-history', 'warning'], 'syllabus' => ['Syllabus', 'bi-list-columns', 'info'], 'model' => ['Model Q.', 'bi-file-earmark-check', 'success']] as $val => $data)
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="type" id="type_{{ $val }}" value="{{ $val }}" {{ $val == 'note' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-{{ $data[2] }} w-100 py-2 rounded-3 border-dashed small d-flex align-items-center justify-content-center gap-2" for="type_{{ $val }}">
                                            <i class="bi {{ $data[1] }}"></i> {{ $data[0] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: File & Content --}}
                    <div class="p-4 p-md-5 bg-light bg-opacity-30 border-bottom">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="bg-primary-blue text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 24px; height: 24px; font-size: 12px;">2</span>
                            <h6 class="fw-bold mb-0 text-primary-blue">Resource File & Access</h6>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold small">Upload File</label>
                                <div class="upload-area p-5 border-dashed rounded-4 text-center bg-white cursor-pointer @error('file') border-danger @enderror" id="dropArea">
                                    <div id="uploadPlaceholder">
                                        <i class="bi bi-file-earmark-pdf text-muted display-4 mb-3 d-block"></i>
                                        <h6 class="fw-bold mb-1">Click to select or drag and drop</h6>
                                        <p class="text-muted extra-small mb-0">PDF, DOCX, JPG, PNG (Max 10MB)</p>
                                    </div>
                                    <div id="fileSelectedView" class="d-none">
                                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-4 d-inline-block mb-3">
                                            <i class="bi bi-file-check fs-1"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1 text-primary-blue" id="fileNameDisplay">Filename.pdf</h6>
                                        <button type="button" class="btn btn-link btn-sm text-danger text-decoration-none" onclick="resetFileUpload(event)">Change File</button>
                                    </div>
                                    <input type="file" name="file" class="d-none" id="fileInput" required>
                                </div>
                                @error('file')
                                    <div class="text-danger extra-small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Short Description (Optional)</label>
                                <textarea name="description" class="form-control rounded-3 bg-white border @error('description') is-invalid @enderror" rows="3" 
                                          placeholder="Brief summary of what this resource covers...">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-4 bg-white shadow-sm d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                                            <i class="bi bi-star-fill fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Premium Resource</h6>
                                            <p class="mb-0 extra-small text-muted">Restrict access to pro members only</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch fs-4">
                                        <input class="form-check-input cursor-pointer" type="checkbox" name="is_premium" id="is_premium" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 3: Finalize --}}
                    <div class="p-4 p-md-5 text-center">
                        <p class="small text-muted mb-4"><i class="bi bi-info-circle me-1"></i> Once published, this resource will be immediately available to students in the selected category.</p>
                        <button type="submit" class="btn btn-primary-blue btn-lg px-5 rounded-pill fw-bold shadow-lg">
                            <i class="bi bi-cloud-upload me-2"></i>Publish Resource Now
                        </button>
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
                {{-- Step 1: Main Categories --}}
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

                {{-- Step 2: Specific Exams (Sub-categories) --}}
                <div id="examStep" class="d-none">
                    <button class="btn btn-sm btn-light rounded-pill mb-4 px-3 fw-bold" onclick="backToCategories()">
                        <i class="bi bi-arrow-left me-2"></i>Back to Categories
                    </button>
                    <div class="row g-3" id="examList">
                        {{-- Populated via JS --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Category Mapping Data for JS --}}
<script>
    const allCourses = @json($courses);
    const categoryMapping = {
        'admin': [
            { label: 'NON-GAZETTED (गैर-राजपत्रांकित)', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] },
            { label: 'GAZETTED (राजपत्रांकित)', items: ['Section Officer (शाखा अधिकृत)'] }
        ],
        'police': [
            { label: 'POSTS (पदहरू)', items: ['Constable (प्रहरी जवान)', 'Assistant Sub Inspector (प्रहरी सहायक निरीक्षक)', 'Inspector (प्रहरी निरीक्षक)'] }
        ],
        'army': [
            { label: 'POSTS (पदहरू)', items: ['Sainik (सैनिक)', 'Second Lieutenant (सहायक सेनानी)'] }
        ],
        'judicial': [
            { label: 'NON-GAZETTED (गैर-राजपत्रांकित)', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] },
            { label: 'GAZETTED (राजपत्रांकित)', items: ['Section Officer (शाखा अधिकृत)', 'Judge (न्यायाधीश)'] }
        ],
        'foreign': [
            { label: 'NON-GAZETTED (गैर-राजपत्रांकित)', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] },
            { label: 'GAZETTED (राजपत्रांकित)', items: ['Section Officer (शाखा अधिकृत)'] }
        ],
        'audit': [
            { label: 'NON-GAZETTED (गैर-राजपत्रांकित)', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] },
            { label: 'GAZETTED (राजपत्रांकित)', items: ['Section Officer (शाखा अधिकृत)'] }
        ],
        'parliament': [
            { label: 'NON-GAZETTED (गैर-राजपत्रांकित)', items: ['Kharidar (खरिदार)', 'Nayab Subba (नायब सुब्बा)'] },
            { label: 'GAZETTED (राजपत्रांकित)', items: ['Section Officer (शाखा अधिकृत)'] }
        ],
        'technical': [
            { label: 'ENGINEERING (इञ्जिनियरिङ)', items: ['Sub Engineer', 'Engineer'] },
            { label: 'AGRICULTURE (कृषि)', items: ['Junior Technical Assistant', 'Technical Assistant', 'Agriculture Officer'] },
            { label: 'FOREST (वन)', items: ['Forest Guard', 'Forest Ranger', 'Forest Officer'] },
            { label: 'HEALTH (स्वास्थ्य)', items: ['Health Assistant', 'Staff Nurse', 'Lab Technician', 'Health Officer'] },
            { label: 'EDUCATION (शिक्षा)', items: ['Primary Teacher', 'Secondary Teacher', 'Education Officer'] }
        ]
    };
</script>

@section('extra_css')
<style>
    .border-dashed { border: 2px dashed #dee2e6 !important; }
    .upload-area { transition: all 0.3s ease; }
    .upload-area:hover { border-color: var(--primary-blue) !important; background: #f8f9ff !important; }
    .btn-outline-primary.border-dashed:hover { border-style: solid !important; }
    .btn-check:checked + .btn-outline-primary { background-color: var(--primary-blue); color: white; border-style: solid; }
    .btn-check:checked + .btn-outline-warning { background-color: #ffc107; color: black; border-style: solid; }
    
    .cursor-pointer { cursor: pointer; }
    .hover-shadow { transition: all 0.3s ease; }
    .hover-shadow:hover { 
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1) !important;
        border-color: var(--primary-blue) !important;
    }
    .category-btn:active, .hover-shadow:active { 
        transform: scale(0.96); 
        background-color: #f0f7ff !important;
    }
</style>
@endsection

@section('extra_js')
<script>
    function showSubCategories(catId, catName) {
        document.getElementById('selectorTitle').textContent = catName;
        document.getElementById('categoryStep').classList.add('d-none');
        document.getElementById('examStep').classList.remove('d-none');
        
        const list = document.getElementById('examList');
        list.innerHTML = '';
        
        const subGroups = categoryMapping[catId] || [];
        
        if (subGroups.length === 0) {
            list.innerHTML = '<div class="col-12 text-center py-4 text-muted small">No specific exams found in this category.</div>';
            return;
        }

        subGroups.forEach(group => {
            const header = document.createElement('div');
            header.className = 'col-12 mt-4 first:mt-0';
            header.innerHTML = `<h6 class="text-primary-blue fw-bold small border-bottom pb-2 mb-3">${group.label}</h6>`;
            list.appendChild(header);

            const filtered = allCourses.filter(course => {
                return group.items.some(key => course.title === key);
            });

            if (filtered.length === 0) {
                const empty = document.createElement('div');
                empty.className = 'col-12 text-muted extra-small italic ps-3 mb-3';
                empty.textContent = 'No materials available for this rank yet.';
                list.appendChild(empty);
            } else {
                const row = document.createElement('div');
                row.className = 'row g-3 px-2';
                filtered.forEach(course => {
                    const col = document.createElement('div');
                    col.className = 'col-md-6';
                    col.innerHTML = `
                        <div class="card border rounded-3 p-3 cursor-pointer hover-shadow bg-white" onclick="selectCourse(${course.id}, '${course.title}')">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-accent-orange rounded-circle p-1" style="width: 8px; height: 8px;"></div>
                                    <span class="fw-bold small text-truncate" style="max-width: 150px;">${course.title}</span>
                                </div>
                                <i class="bi bi-plus-circle text-primary-blue small"></i>
                            </div>
                        </div>
                    `;
                    row.appendChild(col);
                });
                list.appendChild(row);
            }
        });
    }

    function backToCategories() {
        document.getElementById('selectorTitle').textContent = 'Select Service Category';
        document.getElementById('examStep').classList.add('d-none');
        document.getElementById('categoryStep').classList.remove('d-none');
    }

    function selectCourse(id, title) {
        document.getElementById('course_id_input').value = id;
        document.getElementById('selectedCourseName').textContent = title;
        document.getElementById('selectedCourseName').classList.remove('text-muted');
        document.getElementById('selectedCourseName').classList.add('text-dark', 'fw-bold');
        bootstrap.Modal.getInstance(document.getElementById('serviceSelectorModal')).hide();
    }

    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const dropArea = document.getElementById('dropArea');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const fileSelectedView = document.getElementById('fileSelectedView');

    dropArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileNameDisplay.textContent = this.files[0].name;
            uploadPlaceholder.classList.add('d-none');
            fileSelectedView.classList.remove('d-none');
        }
    });

    function resetFileUpload(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadPlaceholder.classList.remove('d-none');
        fileSelectedView.classList.add('d-none');
    }

    // Slug Preview Logic
    const titleInput = document.getElementById('materialTitle');
    const slugPreview = document.getElementById('slugPreview');

    titleInput.addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        slugPreview.textContent = '/' + (slug || 'resource-title');
    });

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

    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        if (files.length > 0) {
            fileNameDisplay.textContent = 'Selected: ' + files[0].name;
            fileNameDisplay.classList.remove('d-none');
        }
    }
</script>
@endsection
