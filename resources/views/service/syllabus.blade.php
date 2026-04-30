<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Exam Syllabus | LokSewa Tayari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <style>
        body { background-color: var(--light-bg); padding-top: 76px; }
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .syllabus-table th { background: #f8f9fa; color: var(--primary-blue); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white border-bottom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-blue d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-journal-bookmark-fill me-2 text-accent-orange"></i> LokSewa Tayari
            </a>
            <div class="ms-auto">
                <a href="{{ route('service.show', $slug) }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </nav>

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

        <div class="mt-4 p-4 bg-white rounded-4 shadow-sm border-start border-4 border-accent-orange">
            <h5 class="fw-bold mb-2">Important Note</h5>
            <p class="text-muted mb-0 small">The syllabus mentioned above is based on the latest LokSewa Aayog standards. Candidates are advised to keep checking for periodic updates.</p>
        </div>
    </div>
</body>
</html>
