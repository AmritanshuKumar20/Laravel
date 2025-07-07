@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Message -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
            <p class="text-muted">Your dashboard overview</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Ideas</h6>
                            <h3>{{ $totalIdeas }}</h3>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-lightbulb fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Active Schemes</h6>
                            <h3>{{ $totalSchemes }}</h3>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Collaborations</h6>
                            <h3>{{ $totalCollaborations }}</h3>
                        </div>
                        <div class="text-warning">
                            <i class="fas fa-handshake fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('ideas.create') }}" class="action-button primary">
                                <i class="fas fa-plus-circle"></i>
                                <span>Submit New Idea</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('schemes.create') }}" class="action-button success">
                                <i class="fas fa-file-alt"></i>
                                <span>Post New Scheme</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('ideas.browse') }}" class="action-button warning">
                                <i class="fas fa-search"></i>
                                <span>Browse Ideas</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('analytics.index') }}" class="action-button info">
                                <i class="fas fa-chart-line"></i>
                                <span>View Analytics</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if($recentIdeas->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentIdeas as $idea)
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-lightbulb text-primary me-3"></i>
                                        <div>
                                            <h6 class="mb-0">{{ $idea->title }}</h6>
                                            <small class="text-muted">{{ $idea->created_at->diffForHumans() }}</small>
                                        </div>
                                        <a href="{{ route('ideas.show', $idea) }}" class="btn btn-sm btn-outline-primary ms-auto">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($totalIdeas > 5)
                            <div class="text-center mt-3">
                                <a href="{{ route('ideas.browse') }}" class="btn btn-outline-primary">View All Ideas</a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <div class="text-muted mb-3">
                                <i class="fas fa-lightbulb fa-3x"></i>
                            </div>
                            <h5>No recent activity</h5>
                            <p class="text-muted">Submit your first idea!</p>
                            <a href="{{ route('ideas.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Submit New Idea
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    margin-bottom: 1rem;
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

.action-button {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 8px;
    color: #fff;
    text-decoration: none;
    transition: all 0.2s ease;
    margin-bottom: 0.5rem;
}

.action-button:hover {
    transform: translateY(-2px);
    color: #fff;
    text-decoration: none;
}

.action-button i {
    font-size: 1.25rem;
    margin-right: 0.75rem;
}

.action-button span {
    font-weight: 500;
}

.action-button.primary {
    background-color: #3b82f6;
}

.action-button.primary:hover {
    background-color: #2563eb;
}

.action-button.success {
    background-color: #10b981;
}

.action-button.success:hover {
    background-color: #059669;
}

.action-button.warning {
    background-color: #f59e0b;
}

.action-button.warning:hover {
    background-color: #d97706;
}

.action-button.info {
    background-color: #6366f1;
}

.action-button.info:hover {
    background-color: #4f46e5;
}

.list-group-item {
    border: none;
    padding: 1rem 0;
}

.list-group-item:not(:last-child) {
    border-bottom: 1px solid #eee;
}

@media (max-width: 768px) {
    .action-button {
        margin-bottom: 1rem;
    }
}
</style>
@endsection
