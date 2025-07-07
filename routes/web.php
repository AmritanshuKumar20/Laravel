<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Social Authentication Routes
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/auth/facebook', [SocialiteController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback'])->name('facebook.callback');

Route::get('/auth/github', [SocialiteController::class, 'redirectToGithub'])->name('github.login');
Route::get('/auth/github/callback', [SocialiteController::class, 'handleGithubCallback'])->name('github.callback');

// Authentication Routes
require __DIR__.'/auth.php';

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $recentIdeas = \App\Models\Idea::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalIdeas = \App\Models\Idea::where('user_id', $user->id)->count();
        $totalSchemes = \App\Models\Scheme::where('user_id', $user->id)->count();
        $totalCollaborations = 0; // You can update this based on your collaboration logic

        return view('dashboard', compact('recentIdeas', 'totalIdeas', 'totalSchemes', 'totalCollaborations'));
    })->name('dashboard');

    // Entrepreneur Routes
    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
    Route::get('/ideas/browse', [IdeaController::class, 'browse'])->name('ideas.browse');
    Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show');
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
    Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');
    Route::post('/ideas/{idea}/like', [IdeaController::class, 'toggleLike'])->name('ideas.like');
    Route::post('/ideas/{idea}/comment', [IdeaController::class, 'comment'])->name('ideas.comment');

    // Government Routes
    Route::get('/schemes/create', [SchemeController::class, 'create'])->name('schemes.create');
    Route::post('/schemes', [SchemeController::class, 'store'])->name('schemes.store');
    Route::get('/schemes', [SchemeController::class, 'index'])->name('schemes.index');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/ideas', [AdminController::class, 'ideas'])->name('admin.ideas');
    Route::get('/schemes', [AdminController::class, 'schemes'])->name('admin.schemes');
});
