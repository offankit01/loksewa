@extends('layouts.admin')

@section('title', 'Edit Mock Test')

@section('breadcrumb')
    <li class="breadcrumb-item small"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item small"><a href="{{ route('admin.tests.index') }}" class="text-decoration-none">Mock Tests</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Edit Test</li>
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

@section('page_title', 'Edit Mock Test')

@section('admin_content')
<form action="{{ route('admin.tests.update', $test) }}" method="POST" id="manualTestForm">
    @csrf
    @method('PATCH')
    <div class="row g-4">
        {{-- Configuration Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4">Exam Config</h5>
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Exam Title</label>
                    <input type="text" name="title" class="form-control rounded-3" value="{{ old('title', $test->title) }}" placeholder="e.g. Kharidar 2081 Set A" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Service Category</label>
                    <div id="selectedServiceDisplay" class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#serviceSelectorModal">
                        <span class="text-dark fw-bold" id="selectedCourseName">{{ $test->course->title ?? 'Select Service Category...' }}</span>
                        <i class="bi bi-chevron-right small"></i>
                    </div>
                    <input type="hidden" name="course_id" id="course_id_input" value="{{ $test->course_id }}" required>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label extra-small fw-bold">Time (Min)</label>
                        <input type="number" name="time_limit" class="form-control rounded-3" value="{{ old('time_limit', $test->time_limit) }}" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label extra-small fw-bold">Difficulty</label>
                        <select name="difficulty" class="form-select rounded-3">
                            <option value="easy" {{ $test->difficulty == 'easy' ? 'selected' : '' }}>Easy</option>
                            <option value="medium" {{ $test->difficulty == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="hard" {{ $test->difficulty == 'hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <button type="submit" class="btn btn-primary-blue w-100 rounded-pill py-2 fw-bold shadow-sm mb-2">
                        <i class="bi bi-check2-all me-2"></i>Update & Publish
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
                    <h5 class="fw-bold mb-0">Question List (<span id="totalQuestionsCount">{{ $test->questions->count() }}</span>)</h5>
                    <button type="button" class="btn btn-primary-blue rounded-pill px-3 btn-sm" id="addQuestionBtn">
                        <i class="bi bi-plus-lg me-2"></i>Add Question
                    </button>
                </div>

                <div id="questionsContainer">
                    @foreach($test->questions as $index => $q)
                    <div class="question-item bg-light p-4 rounded-4 mb-4 border" data-index="{{ $index }}">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge bg-white text-dark border px-3 py-2 rounded-pill fw-bold">Question {{ $index + 1 }}</span>
                            <button type="button" class="btn btn-sm btn-link text-danger remove-question {{ $test->questions->count() == 1 ? 'd-none' : '' }}">Remove</button>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Question</label>
                            <textarea name="questions[{{ $index }}][text]" class="form-control rounded-3 border-0 shadow-sm" rows="2" required>{{ $q->question_text }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="questions[{{ $index }}][a]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option A" value="{{ $q->option_a }}" required></div>
                            <div class="col-md-6"><input type="text" name="questions[{{ $index }}][b]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option B" value="{{ $q->option_b }}" required></div>
                            <div class="col-md-6"><input type="text" name="questions[{{ $index }}][c]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option C" value="{{ $q->option_c }}" required></div>
                            <div class="col-md-6"><input type="text" name="questions[{{ $index }}][d]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Option D" value="{{ $q->option_d }}" required></div>
                        </div>

                        <div class="mt-3 d-flex align-items-center gap-3">
                            <label class="form-label small fw-bold mb-0 text-muted">Correct:</label>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="questions[{{ $index }}][correct]" id="q{{ $index }}a" value="a" {{ $q->correct_option == 'a' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary btn-sm rounded-start-pill px-3" for="q{{ $index }}a">A</label>
                                
                                <input type="radio" class="btn-check" name="questions[{{ $index }}][correct]" id="q{{ $index }}b" value="b" {{ $q->correct_option == 'b' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary btn-sm px-3" for="q{{ $index }}b">B</label>
                                
                                <input type="radio" class="btn-check" name="questions[{{ $index }}][correct]" id="q{{ $index }}c" value="c" {{ $q->correct_option == 'c' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary btn-sm px-3" for="q{{ $index }}c">C</label>
                                
                                <input type="radio" class="btn-check" name="questions[{{ $index }}][correct]" id="q{{ $index }}d" value="d" {{ $q->correct_option == 'd' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary btn-sm rounded-end-pill px-3" for="q{{ $index }}d">D</label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Re-use Modals and JS from Create --}}
@include('admin.tests.partials.bulk_modal')
@include('admin.tests.partials.service_modal')

@endsection

@section('extra_js')
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
            { label: 'NON-GAZETTED (गैर-राजपत्रांकित)', items: ['Kharidar (खरिदार)', 'Nayab सुब्बा (नायब सुब्बा)'] },
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

    let questionCount = {{ $test->questions->count() }};
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
        reindexQuestions();
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
            
            // Toggle remove button visibility
            const removeBtn = item.querySelector('.remove-question');
            if (items.length === 1) removeBtn.classList.add('d-none');
            else removeBtn.classList.remove('d-none');
        });
        questionCount = items.length;
    }

    // Re-use bulk parsing logic
    let lastParsedQuestions = [];
    document.getElementById('processBulkBtn').addEventListener('click', () => {
        const text = document.getElementById('bulkDataInput').value;
        if (!text.trim()) return;
        lastParsedQuestions = parseBulkQuestions(text);
        if (lastParsedQuestions.length === 0) {
            alert('Could not detect any valid questions.');
            return;
        }
        const previewList = document.getElementById('previewList');
        const previewSection = document.getElementById('importPreview');
        const confirmBtn = document.getElementById('confirmImportBtn');
        const processBtn = document.getElementById('processBulkBtn');
        previewList.innerHTML = lastParsedQuestions.map((q, i) => `
            <div class="mb-3 pb-3 border-bottom last:border-0">
                <div class="fw-bold mb-1">${i+1}. ${q.text}</div>
                <div class="row g-2 extra-small text-muted">
                    <div class="col-6 ${q.correct === 'a' ? 'text-success fw-bold' : ''}">A: ${q.a}</div>
                    <div class="col-6 ${q.correct === 'b' ? 'text-success fw-bold' : ''}">B: ${q.b}</div>
                    <div class="col-6 ${q.correct === 'c' ? 'text-success fw-bold' : ''}">C: ${q.c}</div>
                    <div class="col-6 ${q.correct === 'd' ? 'text-success fw-bold' : ''}">D: ${q.d}</div>
                </div>
            </div>
        `).join('');
        document.getElementById('parsedCount').textContent = lastParsedQuestions.length;
        previewSection.classList.remove('d-none');
        confirmBtn.classList.remove('d-none');
        processBtn.textContent = 'Re-Analyze Text';
    });

    document.getElementById('confirmImportBtn').addEventListener('click', () => {
        if (lastParsedQuestions.length === 0) return;
        if (confirm('This will append these questions to the current list. Continue?')) {
            lastParsedQuestions.forEach(data => {
                container.insertAdjacentHTML('beforeend', createQuestionHtml(questionCount, data));
                questionCount++;
            });
            updateCount();
            reindexQuestions();
            bootstrap.Modal.getInstance(document.getElementById('bulkImportModal')).hide();
            document.getElementById('bulkDataInput').value = '';
        }
    });

    function parseBulkQuestions(text) {
        const results = [];
        const lines = text.split('\n').map(l => l.trim()).filter(l => l.length > 0);
        if (lines.length === 0) return results;
        let currentQ = null;
        for (let i = 0; i < lines.length; i++) {
            const line = lines[i];
            const ansMatch = line.match(/^(?:ans(?:wer)?|correct|solution|key|right\s*option)[\s\:\-\=]*([a-d])\b/i) 
                          || line.match(/^[\(\[]\s*([a-d])\s*[\)\]]$/i)
                          || line.match(/^([a-d])[\.\)]\s*is\s*the\s*correct/i);
            const optMatch = line.match(/^([A-D])[\.\)\s]+\s*(.*)/i);
            const isNumbered = /^(?:Q[a-z]*\s*)?\d+[\.\)]/i.test(line);
            const isPotentialQuestion = !ansMatch && !optMatch && line.length > 5;
            if (isNumbered || (isPotentialQuestion && (!currentQ || currentQ.correct || currentQ.options.length >= 4))) {
                if (currentQ && isValidQuestion(currentQ)) results.push(formatParsedQuestion(currentQ));
                currentQ = { text: line.replace(/^(?:Q[a-z]*\s*)?\d+[\.\)]\s*/i, ''), options: [], correct: null };
            } else if (currentQ) {
                if (ansMatch) currentQ.correct = (ansMatch[1] || ansMatch[2]).toLowerCase();
                else if (optMatch) currentQ.options.push(optMatch[2]);
                else if (currentQ.options.length === 0 && !currentQ.correct) currentQ.text += ' ' + line;
                else if (currentQ.options.length < 4 && !currentQ.correct) currentQ.options.push(line);
            }
        }
        if (currentQ && isValidQuestion(currentQ)) results.push(formatParsedQuestion(currentQ));
        return results;
    }

    function isValidQuestion(q) { return q.text && q.text.length > 5 && q.options.length >= 2; }
    function formatParsedQuestion(q) {
        const opts = [...q.options];
        while (opts.length < 4) opts.push('---');
        return { text: q.text.trim(), a: opts[0], b: opts[1], c: opts[2], d: opts[3], correct: q.correct || 'a' };
    }
</script>
@endsection