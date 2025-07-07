@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('ideas.browse') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left"></i> Back to Ideas
        </a>
    </div>

    <!-- Idea Header -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-primary">{{ $idea->category }}</span>
                <div class="text-muted">
                    <span class="me-3"><i class="fas fa-eye"></i> {{ $idea->views ?? 0 }} views</span>
                    <span><i class="fas fa-calendar"></i> {{ $idea->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            <h1 class="card-title h2 mb-3">{{ $idea->title }}</h1>
            <div class="d-flex align-items-center mb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($idea->user->name) }}" 
                    class="rounded-circle me-2" width="32" height="32" alt="{{ $idea->user->name }}">
                <div>
                    <h6 class="mb-0">{{ $idea->user->name }}</h6>
                    <small class="text-muted">Entrepreneur</small>
                </div>
            </div>
            <div class="idea-description">
                {!! nl2br(e($idea->description)) !!}
            </div>
        </div>
    </div>

    <!-- Engagement Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Engagement</h5>
                    <div class="d-flex gap-4">
                        <button class="btn btn-outline-primary like-button {{ $idea->isLikedBy(auth()->user()) ? 'liked' : '' }}" 
                                data-idea-id="{{ $idea->id }}">
                            <i class="fas fa-heart"></i> 
                            <span class="likes-count">{{ $idea->likes()->count() }}</span> Likes
                        </button>
                        <button class="btn btn-outline-secondary" id="commentBtn">
                            <i class="fas fa-comment"></i> 
                            <span class="comments-count">{{ $idea->comments()->count() }}</span> Comments
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Comments</h5>
            
            <!-- Comment Form -->
            <form id="commentForm" class="mb-4">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" id="commentText" rows="3" 
                        placeholder="Share your thoughts..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>Post Comment
                </button>
            </form>

            <!-- Comments List -->
            <div id="commentsList">
                @foreach($idea->comments()->with('user')->latest()->get() as $comment)
                    <div class="comment-item mb-3">
                        <div class="d-flex">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" 
                                class="rounded-circle me-2" width="32" height="32" 
                                alt="{{ $comment->user->name }}">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <p class="mb-0">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.idea-description {
    line-height: 1.6;
    color: #4a5568;
}

.comment-item {
    padding: 1rem 0;
    border-bottom: 1px solid #e5e7eb;
    transition: background-color 0.2s ease;
}

.comment-item:hover {
    background-color: #f8fafc;
}

.comment-item:last-child {
    border-bottom: none;
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
}

.gap-4 {
    gap: 1.5rem;
}

.like-button {
    transition: all 0.3s ease;
}

.like-button.liked {
    background-color: #dc3545;
    color: white;
    border-color: #dc3545;
}

.like-button.liked i {
    animation: heartBeat 0.3s ease-in-out;
}

@keyframes heartBeat {
    0% { transform: scale(1); }
    50% { transform: scale(1.3); }
    100% { transform: scale(1); }
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

#commentForm textarea {
    transition: border-color 0.2s ease;
}

#commentForm textarea:focus {
    border-color: #4a5568;
    box-shadow: 0 0 0 0.2rem rgba(74, 85, 104, 0.25);
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeButton = document.querySelector('.like-button');
    const commentForm = document.getElementById('commentForm');
    const commentsList = document.getElementById('commentsList');
    
    // Like functionality
    likeButton?.addEventListener('click', function() {
        fetch(`/ideas/{{ $idea->id }}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.likes-count').textContent = data.likes_count;
                likeButton.classList.toggle('liked', data.liked);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Comment functionality
    commentForm?.addEventListener('submit', function(e) {
        e.preventDefault();
        const commentText = document.getElementById('commentText').value;
        const submitButton = this.querySelector('button[type="submit"]');
        
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Posting...';
        
        fetch(`/ideas/{{ $idea->id }}/comment`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ comment: commentText })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update comments count
                document.querySelector('.comments-count').textContent = data.comments_count;
                
                // Add new comment to the list with animation
                const commentHtml = `
                    <div class="comment-item mb-3" style="opacity: 0; transform: translateY(20px);">
                        <div class="d-flex">
                            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(data.comment.user.name)}" 
                                class="rounded-circle me-2" width="32" height="32" 
                                alt="${data.comment.user.name}">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">${data.comment.user.name}</h6>
                                    <small class="text-muted">Just now</small>
                                </div>
                                <p class="mb-0">${data.comment.comment}</p>
                            </div>
                        </div>
                    </div>
                `;
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = commentHtml;
                const newComment = tempDiv.firstElementChild;
                commentsList.insertBefore(newComment, commentsList.firstChild);
                
                // Animate the new comment
                requestAnimationFrame(() => {
                    newComment.style.transition = 'all 0.3s ease';
                    newComment.style.opacity = '1';
                    newComment.style.transform = 'translateY(0)';
                });
                
                // Clear the form
                document.getElementById('commentText').value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Post Comment';
        });
    });
});
</script>
@endpush
@endsection 