@extends('layouts.admin')

@section('title', 'Manage FAQs')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">FAQs</li>
@endsection

@section('page_title', 'Frequently Asked Questions')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Platform FAQs</h5>
            <button class="btn btn-primary-blue rounded-pill px-4 btn-sm">
                <i class="bi bi-plus-lg me-2"></i>New FAQ
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0" style="width: 30%;">Question</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Answer</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td class="border-0 fw-bold small text-wrap">{{ $faq['question'] }}</td>
                            <td class="border-0 small text-muted text-wrap">{{ $faq['answer'] }}</td>
                            <td class="border-0 text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light rounded-pill px-3 me-2">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light text-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
