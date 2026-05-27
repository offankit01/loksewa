@extends('layouts.main')

@php
    $hide_nav_footer = true;
@endphp

@section('title', 'Attempting ' . $mockTest->title)

@section('body_class', 'exam-mode')

@section('extra_css')
    <style>
        body.exam-mode { padding-top: 0 !important; background-color: #f8f9fa; }
        .test-header { background: white; border-bottom: 1px solid rgba(0,0,0,0.05); padding: 1rem 0; position: sticky; top: 0; z-index: 1000; }
        .timer-badge { background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; font-family: monospace; }
        .question-card { background: white; border-radius: 1.25rem; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .option-item { cursor: pointer; transition: all 0.2s ease; border: 2px solid #f1f5f9; border-radius: 1rem; padding: 1.25rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 3px; }
        .option-item:hover { border-color: var(--primary-blue); background: rgba(30, 58, 138, 0.02); }
        .option-item.selected { border-color: var(--primary-blue); background: rgba(30, 58, 138, 0.05); color: var(--primary-blue); font-weight: 600; }
        .option-radio { width: 20px; height: 20px; border: 2px solid #cbd5e1; border-radius: 50%; position: relative; flex-shrink: 0; }
        .option-item.selected .option-radio { border-color: var(--primary-blue); }
        .option-item.selected .option-radio::after { content: ''; position: absolute; width: 10px; height: 10px; background: var(--primary-blue); border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .question-nav-btn { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 600; border: 1px solid #e2e8f0; background: white; cursor: pointer; transition: all 0.2s ease; }
        .question-nav-btn:hover { background: #f8fafc; border-color: var(--primary-blue); }
        .question-nav-btn.active { background: var(--primary-blue); color: white; border-color: var(--primary-blue); }
        .question-nav-btn.answered { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
    </style>
@endsection

@section('content')
    <div class="test-header shadow-sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3">
                        <i class="bi bi-pencil-square fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $mockTest->title }}</h5>
                        <span class="badge bg-light text-dark extra-small rounded-pill">{{ ucfirst($difficulty) }} Level</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <button class="btn btn-outline-primary-blue rounded-pill px-4 fw-bold small" onclick="showReviewGrid()">
                        <i class="bi bi-grid-3x3-gap me-2"></i> Review All
                    </button>
                    <div class="timer-badge px-4 py-2 rounded-pill d-flex align-items-center gap-2">
                        <i class="bi bi-clock-history"></i>
                        <span class="fw-bold fs-5" id="timer">{{ $mockTest->time_limit }}:00</span>
                    </div>
                    <button class="btn btn-primary-custom rounded-pill px-4 fw-bold shadow-sm" onclick="finishTest()">Finish Test</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Questions List (Sidebar) -->
            <div class="col-lg-4 order-lg-2">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h6 class="fw-bold mb-4">Question Progress</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @foreach($questions as $index => $q)
                        <button class="question-nav-btn {{ $index == 0 ? 'active' : '' }}" onclick="goToQuestion({{ $index }})" id="nav-{{ $index }}">
                            {{ $index + 1 }}
                        </button>
                        @endforeach
                    </div>
                    <hr class="text-muted opacity-10">
                    <div class="d-flex flex-column gap-2 mt-4">
                        <div class="d-flex align-items-center gap-2 small text-muted">
                            <div class="question-nav-btn answered" style="width: 20px; height: 20px;"></div> Answered
                        </div>
                        <div class="d-flex align-items-center gap-2 small text-muted">
                            <div class="question-nav-btn" style="width: 20px; height: 20px;"></div> Not Visited
                        </div>
                        <div class="d-flex align-items-center gap-2 small text-muted">
                            <div class="question-nav-btn active" style="width: 20px; height: 20px;"></div> Current
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Question -->
            <div class="col-lg-8 order-lg-1">
                <div id="question-container">
                    @foreach($questions as $index => $q)
                    <div class="question-wrapper {{ $index == 0 ? '' : 'd-none' }}" id="q-{{ $index }}">
                        <div class="question-card p-4 p-md-5 mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold">Question {{ $index + 1 }} of {{ count($questions) }}</span>
                                <span class="text-muted small">Difficulty: {{ ucfirst($q->difficulty) }}</span>
                            </div>
                            <h4 class="fw-bold mb-5 leading-relaxed">{{ $q->question_text }}</h4>
                            
                            <div class="options-container">
                                <div class="option-item" onclick="selectOption({{ $index }}, 'a')" id="q{{ $index }}-oa">
                                    <div class="option-radio me-3"></div>
                                    <div class="flex-grow-1">{{ $q->option_a }}</div>
                                </div>
                                <div class="option-item" onclick="selectOption({{ $index }}, 'b')" id="q{{ $index }}-ob">
                                    <div class="option-radio me-3"></div>
                                    <div class="flex-grow-1">{{ $q->option_b }}</div>
                                </div>
                                <div class="option-item" onclick="selectOption({{ $index }}, 'c')" id="q{{ $index }}-oc">
                                    <div class="option-radio me-3"></div>
                                    <div class="flex-grow-1">{{ $q->option_c }}</div>
                                </div>
                                <div class="option-item" onclick="selectOption({{ $index }}, 'd')" id="q{{ $index }}-od">
                                    <div class="option-radio me-3"></div>
                                    <div class="flex-grow-1">{{ $q->option_d }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold" onclick="prevQuestion({{ $index }})" {{ $index == 0 ? 'disabled' : '' }}>
                                <i class="bi bi-arrow-left me-2"></i> Previous
                            </button>
                            @if($index == count($questions) - 1)
                                <button class="btn btn-primary-blue rounded-pill px-5 py-2 fw-bold shadow-lg" onclick="showCompletionModal()">
                                    Submit Test <i class="bi bi-check2-all ms-2"></i>
                                </button>
                            @else
                                <button class="btn btn-primary-blue rounded-pill px-5 py-2 fw-bold shadow-lg" onclick="nextQuestion({{ $index }})">
                                    Next Question <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <form id="submit-test-form" action="{{ route('mock-tests.submit', $mockTest->slug) }}" method="POST" class="d-none">
        @csrf
        <input type="hidden" name="answers" id="answers-input">
        <input type="hidden" name="difficulty" value="{{ $difficulty }}">
    </form>

    <!-- Completion Modal -->
    <div class="modal fade" id="completionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-body p-5 text-center">
                    <div class="bg-success bg-opacity-10 text-success p-4 rounded-circle d-inline-flex mb-4">
                        <i class="bi bi-check-lg fs-1"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Test Completed!</h3>
                    <p class="text-muted mb-4">You have reached the end of the mock test. Your answers have been recorded. You can now submit to see your detailed performance analysis.</p>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary-blue btn-lg rounded-pill fw-bold" onclick="finishTest()">View Results Now</button>
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Go Back & Review</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Grid Modal -->
    <div class="modal fade" id="reviewGridModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold m-0"><i class="bi bi-grid-3x3-gap text-primary-blue me-2"></i>Review All Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 text-center">
                                <h4 class="fw-bold mb-0 text-success" id="answeredCount">0</h4>
                                <div class="extra-small text-muted text-uppercase">Answered</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 text-center">
                                <h4 class="fw-bold mb-0 text-danger" id="unansweredCount">0</h4>
                                <div class="extra-small text-muted text-uppercase">Unanswered</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 text-center">
                                <h4 class="fw-bold mb-0 text-primary-blue" id="totalCount">{{ count($questions) }}</h4>
                                <div class="extra-small text-muted text-uppercase">Total</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3 justify-content-center" id="reviewGridList">
                        @foreach($questions as $index => $q)
                        <div class="question-nav-btn" style="width: 50px; height: 50px; font-size: 1.1rem;" onclick="goToQuestion({{ $index }})" data-bs-dismiss="modal" id="review-nav-{{ $index }}">
                            {{ $index + 1 }}
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Continue Exam</button>
                    <button type="button" class="btn btn-primary-blue rounded-pill px-4 fw-bold" onclick="showCompletionModal()" data-bs-dismiss="modal">Submit Exam</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentIdx = 0;
        const totalQuestions = {{ count($questions) }};
        const answers = {};

        function showReviewGrid() {
            const answered = Object.keys(answers).length;
            document.getElementById('answeredCount').textContent = answered;
            document.getElementById('unansweredCount').textContent = totalQuestions - answered;
            
            // Sync status to grid
            for(let i=0; i<totalQuestions; i++) {
                const btn = document.getElementById(`review-nav-${i}`);
                if (answers[i]) btn.classList.add('answered');
                else btn.classList.remove('answered');
            }

            const modal = new bootstrap.Modal(document.getElementById('reviewGridModal'));
            modal.show();
        }

        function selectOption(qIdx, optionKey) {
            // Remove selection from all options of this question
            const options = document.querySelectorAll(`#q-${qIdx} .option-item`);
            options.forEach(opt => opt.classList.remove('selected'));
            
            // Select the clicked option
            document.getElementById(`q${qIdx}-o${optionKey}`).classList.add('selected');
            answers[qIdx] = optionKey;

            // Mark nav button as answered
            document.getElementById(`nav-${qIdx}`).classList.add('answered');
            
            // Update hidden input
            document.getElementById('answers-input').value = JSON.stringify(answers);
        }

        function goToQuestion(idx) {
            document.querySelectorAll('.question-wrapper').forEach(w => w.classList.add('d-none'));
            document.getElementById(`q-${idx}`).classList.remove('d-none');
            
            document.querySelectorAll('.question-nav-btn').forEach(b => b.classList.remove('active'));
            document.getElementById(`nav-${idx}`).classList.add('active');
            
            currentIdx = idx;
        }

        function nextQuestion(idx) {
            if (idx < totalQuestions - 1) {
                goToQuestion(idx + 1);
            } else {
                showCompletionModal();
            }
        }

        function prevQuestion(idx) {
            if (idx > 0) {
                goToQuestion(idx - 1);
            }
        }

        function showCompletionModal() {
            const modal = new bootstrap.Modal(document.getElementById('completionModal'));
            modal.show();
        }

        function finishTest() {
            document.getElementById('submit-test-form').submit();
        }

        // Timer Logic
        let time = {{ $mockTest->time_limit }} * 60;
        const timerEl = document.getElementById('timer');
        setInterval(() => {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;
            timerEl.innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (time > 0) time--;
            else finishTest(); // Auto-submit when time is up
        }, 1000);
    </script>
@endsection
