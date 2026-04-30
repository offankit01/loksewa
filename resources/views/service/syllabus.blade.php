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
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
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
    </div>
@endsection
