@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Browse Ideas</h2>
            <p class="text-muted">Discover and explore innovative ideas from our community</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="{{ route('ideas.browse') }}" method="GET" class="d-flex gap-3">
                <div class="flex-grow-1">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                            placeholder="Search ideas..." value="{{ request('search') }}">
                    </div>
                </div>
                <select name="category" class="form-select" style="width: auto;">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                <select name="sort" class="form-select" style="width: auto;">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="discussed" {{ request('sort') == 'discussed' ? 'selected' : '' }}>Most Discussed</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Ideas Grid -->
    <div class="row">
        @forelse($ideas as $idea)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge bg-light text-dark">{{ $idea->category }}</span>
                            <div class="text-muted">
                                <i class="fas fa-heart"></i> {{ $idea->likes_count }}
                                <i class="fas fa-comment ms-2"></i> {{ $idea->comments_count }}
                            </div>
                        </div>
                        <h5 class="card-title">{{ $idea->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($idea->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($idea->user->name) }}" 
                                    class="rounded-circle me-2" width="24" height="24" alt="{{ $idea->user->name }}">
                                <small class="text-muted">{{ $idea->user->name }}</small>
                            </div>
                            <a href="{{ route('ideas.show', $idea) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No ideas found matching your criteria.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-12">
            {{ $ideas->withQueryString()->links() }}
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.input-group {
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    border-radius: 8px;
}

.input-group-text {
    border: 1px solid #e5e7eb;
}

.form-control {
    border: 1px solid #e5e7eb;
}

.form-control:focus {
    box-shadow: none;
    border-color: #3b82f6;
}

.form-select {
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    border-radius: 8px;
}

.gap-3 {
    gap: 1rem;
}

.badge {
    font-weight: 500;
    padding: 0.5em 1em;
}
</style>
@endsection 