<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use App\Models\Scheme;
use App\Models\IdeaComment;
use App\Models\IdeaLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        // Get overall statistics
        $stats = [
            'total_users' => User::count(),
            'total_ideas' => Idea::count(),
            'total_schemes' => Scheme::count(),
            'total_comments' => IdeaComment::count(),
            'total_likes' => IdeaLikes::count(),
        ];

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        // Get user growth data
        $userGrowth = $this->getUserGrowthData();

        // Get popular ideas
        $popularIdeas = Idea::withCount(['likes', 'comments'])
            ->with('user')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'userGrowth', 'popularIdeas'));
    }

    public function users()
    {
        $users = User::withCount(['ideas', 'schemes'])
            ->latest()
            ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function ideas()
    {
        $ideas = Idea::with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate(10);

        return view('admin.ideas', compact('ideas'));
    }

    public function schemes()
    {
        $schemes = Scheme::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.schemes', compact('schemes'));
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Get recent ideas
        $recentIdeas = Idea::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($idea) {
                return [
                    'type' => 'idea',
                    'action' => 'created',
                    'user' => $idea->user->name,
                    'title' => $idea->title,
                    'created_at' => $idea->created_at,
                ];
            });

        // Get recent comments
        $recentComments = IdeaComment::with(['user', 'idea'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($comment) {
                return [
                    'type' => 'comment',
                    'action' => 'commented on',
                    'user' => $comment->user->name,
                    'title' => $comment->idea->title,
                    'created_at' => $comment->created_at,
                ];
            });

        // Get recent schemes
        $recentSchemes = Scheme::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($scheme) {
                return [
                    'type' => 'scheme',
                    'action' => 'created',
                    'user' => $scheme->user->name,
                    'title' => $scheme->title,
                    'created_at' => $scheme->created_at,
                ];
            });

        return $activities->concat($recentIdeas)
            ->concat($recentComments)
            ->concat($recentSchemes)
            ->sortByDesc('created_at')
            ->take(10);
    }

    private function getUserGrowthData()
    {
        return User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('M d'),
                    'count' => $item->count,
                ];
            });
    }
} 