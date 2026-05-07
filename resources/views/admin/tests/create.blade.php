@extends('layouts.admin')

@section('title', 'Manual Quiz Generator')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item small"><a href="{{ route('admin.courses.index') }}" class="text-decoration-none">Services</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Generator</li>
@endsection

@section('extra_css')
    <style>
        .cursor-pointer { cursor: pointer; }
        .hover-shadow:hover { 
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1) !important;
            border-color: var(--primary-blue) !important;
        }
        .category-btn { transition: all 0.3s ease; }
        .category-btn:active, .hover-shadow:active { 
            transform: scale(0.96); 
            background-color: #f0f7ff !important;
        }
    </style>
@endsection

@section('page_title', 'Manual Quiz Generator')

@section('admin_content')
<form action="{{ route('admin.tests.store') }}" method="POST" id="manualTestForm">
    @csrf
    <div class="row g-4">
        {{-- Configuration Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4">Exam Config</h5>
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Exam Title</label>
                    <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. Kharidar 2081 Set A" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Service Category</label>
                    <div id="selectedServiceDisplay" class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#serviceSelectorModal">
                        <span class="text-muted" id="selectedCourseName">Select Service Category...</span>
                        <i class="bi bi-chevron-right small"></i>
                    </div>
                    <input type="hidden" name="course_id" id="course_id_input" required>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label extra-small fw-bold">Time (Min)</label>
                        <input type="number" name="time_limit" class="form-control rounded-3" value="45" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label extra-small fw-bold">Difficulty</label>
                        <select name="difficulty" class="form-select rounded-3">
                            <option value="easy">Easy</option>
                            <option value="medium" selected>Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <button type="submit" class="btn btn-primary-blue w-100 rounded-pill py-2 fw-bold shadow-sm mb-2">
                        <i class="bi bi-check2-all me-2"></i>Finalize & Publish
                    </button>
                    <button type="button" class="btn btn-soft-secondary w-100 rounded-pill py-2 small fw-bold" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                        <i class="bi bi-file-earmark-text me-2"></i>Paste All Questions
                    </button>
                </div>
            </div>
        </div>

        {{-- Question List --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Question List (<span id="totalQuestionsCount">1</span>)</h5>
                    <button type="button" class="btn btn-primary-blue rounded-pill px-3 btn-sm" id="addQuestionBtn">
                        <i class="bi bi-plus-lg me-2"></i>Add Question
                    </button>
                </div>

                <div id="questionsContainer">
                    {{-- Default first question --}}
                    <div class="question-item bg-light p-4 rounded-4 mb-4 border" data-index="0">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge bg-white text-dark border px-3 py-2 rounded-pill fw-bold">Question 1</span>
                            <button type="button" class="btn btn-sm btn-link text-danger remove-question d-none">Remove</button>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Question</label>
                            <textarea name="questions[0][text]" class="form-control rounded-3 border-0 shadow-sm" rows="2" required></textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="questions[0][a]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option A" required></div>
                            <div class="col-md-6"><input type="text" name="questions[0][b]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option B" required></div>
                            <div class="col-md-6"><input type="text" name="questions[0][c]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option C" required></div>
                            <div class="col-md-6"><input type="text" name="questions[0][d]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option D" required></div>
                        </div>

                        <div class="mt-3 d-flex align-items-center gap-3">
                            <label class="form-label small fw-bold mb-0 text-muted">Correct:</label>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="questions[0][correct]" id="q0a" value="a" checked>
                                <label class="btn btn-outline-primary btn-sm rounded-start-pill px-3" for="q0a">A</label>
                                
                                <input type="radio" class="btn-check" name="questions[0][correct]" id="q0b" value="b">
                                <label class="btn btn-outline-primary btn-sm px-3" for="q0b">B</label>
                                
                                <input type="radio" class="btn-check" name="questions[0][correct]" id="q0c" value="c">
                                <label class="btn btn-outline-primary btn-sm px-3" for="q0c">C</label>
                                
                                <input type="radio" class="btn-check" name="questions[0][correct]" id="q0d" value="d">
                                <label class="btn btn-outline-primary btn-sm rounded-end-pill px-3" for="q0d">D</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Bulk Import Modal -->
<div class="modal fade" id="bulkImportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold m-0">Bulk Question Importer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info border-0 rounded-4 mb-4 extra-small">
                    <strong>Format:</strong> Question | Option A | Option B | Option C | Option D | Correct (A,B,C,D) <br>
                    <em>One question per line. Example: What is 2+2? | 3 | 4 | 5 | 6 | B</em>
                </div>
                <textarea id="bulkDataInput" class="form-control rounded-4 border-0 bg-light p-3 font-monospace" rows="10" placeholder="Paste your questions here..."></textarea>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-blue rounded-pill px-4 fw-bold" id="processBulkBtn">Import All Now</button>
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
                            <h6 class="fw-bold mb-1 text-dark">{{ $cat['name'] }}</h6>
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
            // Create Group Header
            const header = document.createElement('div');
            header.className = 'col-12 mt-4 first:mt-0';
            header.innerHTML = `<h6 class="text-primary-blue fw-bold small border-bottom pb-2 mb-3">${group.label}</h6>`;
            list.appendChild(header);

            // Filter items for this group
            const filtered = allCourses.filter(course => {
                return group.items.some(key => course.title === key);
            });

            if (filtered.length === 0) {
                const empty = document.createElement('div');
                empty.className = 'col-12 text-muted extra-small italic ps-3 mb-3';
                empty.textContent = 'No exams available under this rank yet.';
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
                                    <span class="fw-bold small">${course.title}</span>
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

    let questionCount = 1;
    const container = document.getElementById('questionsContainer');
    const addBtn = document.getElementById('addQuestionBtn');
    const countDisplay = document.getElementById('totalQuestionsCount');

    function createQuestionHtml(index, data = null) {
        return `
            <div class="question-item bg-light p-4 rounded-4 mb-4 border" data-index="${index}">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-white text-dark border px-3 py-2 rounded-pill fw-bold">Question ${index + 1}</span>
                    <button type="button" class="btn btn-sm btn-link text-danger remove-question">Remove</button>
                </div>
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Question</label>
                    <textarea name="questions[${index}][text]" class="form-control rounded-3 border-0 shadow-sm" rows="2" required>${data ? data.text : ''}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6"><input type="text" name="questions[${index}][a]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option A" value="${data ? data.a : ''}" required></div>
                    <div class="col-md-6"><input type="text" name="questions[${index}][b]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option B" value="${data ? data.b : ''}" required></div>
                    <div class="col-md-6"><input type="text" name="questions[${index}][c]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option C" value="${data ? data.c : ''}" required></div>
                    <div class="col-md-6"><input type="text" name="questions[${index}][d]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option D" value="${data ? data.d : ''}" required></div>
                </div>

                <div class="mt-3 d-flex align-items-center gap-3">
                    <label class="form-label small fw-bold mb-0 text-muted">Correct:</label>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="questions[${index}][correct]" id="q${index}a" value="a" ${!data || data.correct == 'a' ? 'checked' : ''}>
                        <label class="btn btn-outline-primary btn-sm rounded-start-pill px-3" for="q${index}a">A</label>
                        
                        <input type="radio" class="btn-check" name="questions[${index}][correct]" id="q${index}b" value="b" ${data && data.correct == 'b' ? 'checked' : ''}>
                        <label class="btn btn-outline-primary btn-sm px-3" for="q${index}b">B</label>
                        
                        <input type="radio" class="btn-check" name="questions[${index}][correct]" id="q${index}c" value="c" ${data && data.correct == 'c' ? 'checked' : ''}>
                        <label class="btn btn-outline-primary btn-sm px-3" for="q${index}c">C</label>
                        
                        <input type="radio" class="btn-check" name="questions[${index}][correct]" id="q${index}d" value="d" ${data && data.correct == 'd' ? 'checked' : ''}>
                        <label class="btn btn-outline-primary btn-sm rounded-end-pill px-3" for="q${index}d">D</label>
                    </div>
                </div>
            </div>
        `;
    }

    addBtn.addEventListener('click', () => {
        container.insertAdjacentHTML('beforeend', createQuestionHtml(questionCount));
        questionCount++;
        updateCount();
    });

    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-question')) {
            e.target.closest('.question-item').remove();
            reindexQuestions();
            updateCount();
        }
    });

    function updateCount() {
        countDisplay.textContent = container.querySelectorAll('.question-item').length;
    }

    function reindexQuestions() {
        const items = container.querySelectorAll('.question-item');
        items.forEach((item, idx) => {
            item.querySelector('.badge').textContent = `Question ${idx + 1}`;
            item.querySelectorAll('textarea, input').forEach(input => {
                const name = input.getAttribute('name');
                if (name) input.setAttribute('name', name.replace(/questions\[\d+\]/, `questions[${idx}]`));
                const id = input.getAttribute('id');
                if (id && id.startsWith('q')) input.setAttribute('id', id.replace(/q\d+/, `q${idx}`));
            });
            item.querySelectorAll('label').forEach(label => {
                const fr = label.getAttribute('for');
                if (fr && fr.startsWith('q')) label.setAttribute('for', fr.replace(/q\d+/, `q${idx}`));
            });
        });
        questionCount = items.length;
    }

    // Bulk Import Logic
    document.getElementById('processBulkBtn').addEventListener('click', () => {
        const text = document.getElementById('bulkDataInput').value;
        const lines = text.split('\n').filter(line => line.trim() !== '');
        
        if (lines.length === 0) return;

        // Clear existing if confirmed or just append
        if (confirm(`Import ${lines.length} questions? This will be added to your current list.`)) {
            lines.forEach(line => {
                const parts = line.split('|').map(p => p.trim());
                if (parts.length >= 6) {
                    const data = {
                        text: parts[0],
                        a: parts[1],
                        b: parts[2],
                        c: parts[3],
                        d: parts[4],
                        correct: parts[5].toLowerCase()
                    };
                    container.insertAdjacentHTML('beforeend', createQuestionHtml(questionCount, data));
                    questionCount++;
                }
            });
            updateCount();
            reindexQuestions();
            bootstrap.Modal.getInstance(document.getElementById('bulkImportModal')).hide();
            document.getElementById('bulkDataInput').value = '';
        }
    });
</script>
@endsection
