@extends('layouts.main')

@section('title', $title . ' - Exam Syllabus | LokSewa Tayari')

@section('extra_css')
    <style>
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .syllabus-table th { background: #f8f9fa; color: var(--primary-blue); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; }
    </style>
@endsection

@section('content')
    <header class="subpage-header">
        <div class="container text-center">
            <h1 class="fw-bold mb-0">{{ $title }} Exam Syllabus</h1>
            <p class="text-white-50 mt-2 mb-0">Detailed breakdown of marks, exam pattern, and topics</p>
        </div>
    </header>

    <div class="container pb-5">
        {{-- Exam Pattern Summary --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Exam Pattern Summary</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table syllabus-table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="p-4">Paper / Phase</th>
                                <th class="p-4">Subject</th>
                                <th class="p-4">Marks</th>
                                <th class="p-4">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-4 fw-bold">First Paper</td>
                                <td class="p-4">General Knowledge & IQ (GK & IQ)</td>
                                <td class="p-4 text-primary-blue fw-bold">100</td>
                                <td class="p-4 text-muted">45 Mins</td>
                            </tr>
                            <tr>
                                <td class="p-4 fw-bold">Second Paper</td>
                                <td class="p-4">Administrative/Job Related Subjects</td>
                                <td class="p-4 text-primary-blue fw-bold">100</td>
                                <td class="p-4 text-muted">2 Hours 30 Mins</td>
                            </tr>
                            <tr>
                                <td class="p-4 fw-bold">Interview</td>
                                <td class="p-4">Personal Interview & Skills Test</td>
                                <td class="p-4 text-primary-blue fw-bold">30</td>
                                <td class="p-4 text-muted">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Dynamic Syllabus Downloads --}}
        <div class="row g-4">
            <div class="col-12">
                <h5 class="fw-bold mb-4">Official Detailed Syllabus</h5>
            </div>
            @forelse($materials as $material)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-shadow transition-all">
                    <div class="d-flex align-items-center gap-4">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-4">
                            <i class="bi bi-file-earmark-text fs-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">{{ $material->title }}</h5>
                            <p class="text-muted small mb-0">{{ $material->description ?? 'Official syllabus and course details for ' . $title }}</p>
                        </div>
                        <div>
                            <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-download me-2"></i>PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4 bg-light rounded-4">
                <p class="text-muted mb-0 italic small">Detailed syllabus PDF not available for download yet.</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection
