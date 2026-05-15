@extends('layouts.admin')

@section('title', 'Manage Blogs')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Blogs</li>
@endsection

@section('page_title', 'Manage Blog Posts')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Existing Blogs</h5>
            <a href="{{ route('admin.content.blogs.create') }}" class="btn btn-primary-blue rounded-pill px-4 btn-sm">
                <i class="bi bi-plus-lg me-2"></i>New Blog Post
            </a>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Blog Title</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Author</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Views</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                        <tr>
                            <td class="border-0">
                                <div class="fw-bold text-dark">{{ $blog->title }}</div>
                                <div class="extra-small text-muted">SLUG: {{ $blog->slug }}</div>
                            </td>
                            <td class="border-0 small text-muted">{{ $blog->author->name ?? 'Unknown' }}</td>
                            <td class="border-0 text-center">
                                @if($blog->is_published)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill extra-small">Published</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill extra-small">Draft</span>
                                @endif
                            </td>
                            <td class="border-0 text-center small">
                                <span class="fw-bold text-primary-blue">{{ number_format($blog->views) }}</span>
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.content.blogs.edit', $blog) }}" class="btn btn-sm btn-soft-primary rounded-3 p-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.content.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger rounded-3 p-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small italic">No blog posts found. Start by creating one!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
