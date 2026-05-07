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
                    <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                        <i class="bi bi-cloud-arrow-up fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">New Resource Upload</h5>
                        <p class="mb-0 small text-white-50">Upload PDFs, Notes, and Previous Year Questions (PYQs)</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4">
                        {{-- Resource Title --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small">Resource Title</label>
                            <input type="text" name="title" class="form-control form-control-lg rounded-3 bg-light border-0" 
                                   placeholder="e.g. Nepal Constitution 2072 Summary" required>
                        </div>

                        {{-- Category Selection (Step 1 & 2) --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Target Exam / Category</label>
                            <div id="selectedCategoryDisplay" class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#serviceSelectorModal">
                                <span class="text-muted small" id="selectedCourseName">Select Category...</span>
                                <i class="bi bi-chevron-down small"></i>
                            </div>
                            <input type="hidden" name="category" id="course_slug_input" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Resource Type</label>
                            <div class="d-flex gap-3">
                                <div class="flex-grow-1">
                                    <input type="radio" class="btn-check" name="type" id="type_note" value="note" checked>
                                    <label class="btn btn-outline-primary w-100 py-2 rounded-3 border-dashed" for="type_note">
                                        <i class="bi bi-journal-text me-2"></i>Study Note
                                    </label>
                                </div>
                                <div class="flex-grow-1">
                                    <input type="radio" class="btn-check" name="type" id="type_pyq" value="pyq">
                                    <label class="btn btn-outline-warning w-100 py-2 rounded-3 border-dashed" for="type_pyq">
                                        <i class="bi bi-clock-history me-2"></i>PYQ (Previous Year)
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- File Upload Area --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small">Upload File (PDF Recommended)</label>
                            <div class="upload-area p-5 border-dashed rounded-4 text-center bg-light cursor-pointer" id="dropArea">
                                <i class="bi bi-file-earmark-pdf text-muted display-4 mb-3 d-block"></i>
                                <h6 class="fw-bold mb-1">Click to select or drag and drop</h6>
                                <p class="text-muted extra-small mb-3">PDF, DOCX, JPG, PNG (Max 10MB)</p>
                                <input type="file" name="file" class="d-none" id="fileInput" required>
                                <div id="fileNameDisplay" class="badge bg-primary-blue p-2 d-none"></div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small">Short Description (Optional)</label>
                            <textarea name="description" class="form-control rounded-3 bg-light border-0" rows="3" 
                                      placeholder="Brief summary of what this resource covers..."></textarea>
                        </div>

                        {{-- Access Level --}}
                        <div class="col-12">
                            <div class="form-check form-switch p-3 border rounded-3 bg-light bg-opacity-50">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_premium" id="is_premium" value="1">
                                <label class="form-check-label fw-bold small" for="is_premium">
                                    <i class="bi bi-star-fill text-warning me-2"></i>Mark as Premium Content
                                </label>
                                <div class="extra-small text-muted ms-5 mt-1">Premium users will have exclusive access to this resource.</div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-primary-blue w-100 py-3 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-check-circle me-2"></i>Publish Resource Now
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
                        <div class="card border rounded-3 p-3 cursor-pointer hover-shadow bg-white" onclick="selectCourse('${course.slug}', '${course.title}')">
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

    function selectCourse(slug, title) {
        document.getElementById('course_slug_input').value = slug;
        document.getElementById('selectedCourseName').textContent = title;
        document.getElementById('selectedCourseName').classList.remove('text-muted');
        document.getElementById('selectedCourseName').classList.add('text-dark', 'fw-bold');
        bootstrap.Modal.getInstance(document.getElementById('serviceSelectorModal')).hide();
    }

    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');

    dropArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileNameDisplay.textContent = 'Selected: ' + this.files[0].name;
            fileNameDisplay.classList.remove('d-none');
            dropArea.querySelector('i').classList.remove('text-muted');
            dropArea.querySelector('i').classList.add('text-primary-blue');
        }
    });

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.borderColor = 'var(--primary-blue)';
        dropArea.style.background = '#f8f9ff';
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.borderColor = '#dee2e6';
        dropArea.style.background = '#f8f9f9';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileInput.files = e.dataTransfer.files;
        fileInput.dispatchEvent(new Event('change'));
    });
</script>
@endsection
