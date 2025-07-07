@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Time Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Analytics Dashboard</h2>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary active" data-period="week">Week</button>
                            <button type="button" class="btn btn-outline-primary" data-period="month">Month</button>
                            <button type="button" class="btn btn-outline-primary" data-period="year">Year</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Ideas</h6>
                            <h3 class="mb-0">{{ $ideasStats['total'] }}</h3>
                            <div class="trend-indicator mt-2">
                                <span class="badge bg-success">
                                    <i class="fas fa-arrow-up"></i>
                                    {{ $ideasStats['monthly'] }} this month
                                </span>
                            </div>
                        </div>
                        <div class="stat-icon bg-primary-light">
                            <i class="fas fa-lightbulb fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Schemes</h6>
                            <h3 class="mb-0">{{ $schemesStats['total'] }}</h3>
                            <div class="trend-indicator mt-2">
                                <span class="badge bg-success">
                                    <i class="fas fa-arrow-up"></i>
                                    {{ $schemesStats['monthly'] }} this month
                                </span>
                            </div>
                        </div>
                        <div class="stat-icon bg-success-light">
                            <i class="fas fa-file-alt fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Active Users</h6>
                            <h3 class="mb-0">{{ $userEngagement['active_users'] }}</h3>
                            <div class="trend-indicator mt-2">
                                <span class="badge bg-info">
                                    {{ number_format(($userEngagement['active_users'] / $userEngagement['total_users']) * 100, 1) }}% of total
                                </span>
                            </div>
                        </div>
                        <div class="stat-icon bg-info-light">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Interactions</h6>
                            <h3 class="mb-0">{{ $userEngagement['total_likes'] + $userEngagement['total_comments'] }}</h3>
                            <div class="trend-indicator mt-2">
                                <span class="badge bg-warning">
                                    <i class="fas fa-chart-line"></i>
                                    @php
                                        $totalInteractions = $userEngagement['total_likes'] + $userEngagement['total_comments'];
                                        $likesPercentage = $totalInteractions > 0 
                                            ? number_format(($userEngagement['total_likes'] / $totalInteractions) * 100, 1)
                                            : 0;
                                    @endphp
                                    {{ $likesPercentage }}% likes
                                </span>
                            </div>
                        </div>
                        <div class="stat-icon bg-warning-light">
                            <i class="fas fa-handshake fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trending Ideas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Trending Ideas</h5>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-sort="likes">Sort by Likes</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="comments">Sort by Comments</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="recent">Sort by Recent</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush" id="trendingIdeasList">
                        @foreach($ideasStats['trending'] as $idea)
                            <div class="list-group-item idea-item" data-id="{{ $idea->id }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $idea->title }}</h6>
                                        <div class="d-flex align-items-center mt-2">
                                            <button class="btn btn-sm me-2 {{ $idea->user_has_liked ? 'btn-primary' : 'btn-outline-primary' }} btn-like">
                                                <i class="fas fa-heart"></i>
                                                <span class="likes-count">{{ $idea->likes_count }}</span>
                                            </button>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-comment"></i> {{ $idea->comments_count }}
                                            </span>
                                            <span class="text-muted ms-2">
                                                <i class="fas fa-clock"></i> {{ $idea->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('ideas.show', $idea) }}" class="btn btn-sm btn-outline-primary">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Activity -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">User Activity</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Ideas</th>
                                    <th>Schemes</th>
                                    <th>Interactions</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($userEngagement['top_users']) && count($userEngagement['top_users']) > 0)
                                    @foreach($userEngagement['top_users'] as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <span class="avatar-initial rounded-circle bg-primary">
                                                            {{ substr($user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td>{{ $user->ideas_count }}</td>
                                            <td>{{ $user->schemes_count }}</td>
                                            <td>{{ $user->interactions_count }}</td>
                                            <td>
                                                <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-users fa-2x mb-3"></i>
                                                <p class="mb-0">No user activity data available</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    margin-bottom: 1rem;
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #eee;
    padding: 1rem 1.5rem;
}

.card-header h5 {
    font-weight: 600;
    margin: 0;
}

.stat-card {
    overflow: hidden;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-primary-light { background-color: rgba(59, 130, 246, 0.1); }
.bg-success-light { background-color: rgba(16, 185, 129, 0.1); }
.bg-info-light { background-color: rgba(99, 102, 241, 0.1); }
.bg-warning-light { background-color: rgba(245, 158, 11, 0.1); }

.avatar-sm {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-initial {
    color: white;
    font-weight: 600;
}

.list-group-item {
    border: none;
    padding: 1rem 0;
    transition: background-color 0.2s ease;
}

.list-group-item:hover {
    background-color: #f8fafc;
}

.list-group-item:not(:last-child) {
    border-bottom: 1px solid #eee;
}

.trend-indicator {
    font-size: 0.875rem;
}

.table th {
    font-weight: 600;
    color: #64748b;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    padding: 0.5rem 1rem;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    padding: 0.5rem 1rem;
}

.dropdown-item:hover {
    background-color: #f8fafc;
}

.btn-like {
    transition: all 0.2s ease;
}

.btn-like:hover {
    transform: scale(1.05);
}

.chart-container {
    position: relative;
}

.chart-container canvas {
    transition: all 0.3s ease;
}

@keyframes chartFadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: chartFadeIn 0.5s ease-out;
}

.list-group-item {
    transition: all 0.2s ease;
}

.list-group-item:hover {
    transform: translateX(5px);
    background-color: #f8fafc;
}

.badge {
    transition: all 0.2s ease;
}

.badge:hover {
    transform: scale(1.1);
}

.liked-animation {
    animation: likeEffect 0.3s ease;
}

@keyframes likeEffect {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.comment-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #eee;
}

.comment-item:last-child {
    border-bottom: none;
}

.comment-input {
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    padding: 0.5rem;
    width: 100%;
    margin-bottom: 0.5rem;
}

.comment-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 1px #3b82f6;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle sorting
    document.querySelectorAll('[data-sort]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const sortBy = this.dataset.sort;
            const list = document.getElementById('trendingIdeasList');
            const items = Array.from(list.children);
            
            items.sort((a, b) => {
                if (sortBy === 'likes') {
                    return parseInt(b.querySelector('.likes-count').textContent) - 
                           parseInt(a.querySelector('.likes-count').textContent);
                } else if (sortBy === 'comments') {
                    return parseInt(b.querySelector('.badge .fa-comment').nextSibling.textContent) - 
                           parseInt(a.querySelector('.badge .fa-comment').nextSibling.textContent);
                } else if (sortBy === 'recent') {
                    const dateA = new Date(a.querySelector('.text-muted').textContent);
                    const dateB = new Date(b.querySelector('.text-muted').textContent);
                    return dateB - dateA;
                }
            });
            
            items.forEach(item => list.appendChild(item));
        });
    });
});
</script>
@endpush
@endsection 