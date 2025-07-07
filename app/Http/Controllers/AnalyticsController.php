<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Scheme;
use App\Models\User;
use App\Models\IdeaLikes;
use App\Models\IdeaComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Get ideas statistics with proper relationship counting
        $ideasStats = [
            'total' => Idea::count(),
            'monthly' => Idea::whereMonth('created_at', now()->month)->count(),
            'trending' => Idea::withCount(['likes', 'comments'])
                            ->with('user')
                            ->orderBy('likes_count', 'desc')
                            ->take(5)
                            ->get()
                            ->map(function($idea) {
                                $idea->user_has_liked = $idea->likes()
                                    ->where('user_id', auth()->id())
                                    ->exists();
                                return $idea;
                            }),
            'categories' => Idea::select('category', DB::raw('count(*) as count'))
                            ->whereNotNull('category')
                            ->groupBy('category')
                            ->get(),
            'monthly_trends' => collect(range(5, 0))->map(function($months) {
                $date = now()->subMonths($months);
                return [
                    'month' => $date->format('M'),
                    'ideas' => Idea::whereMonth('created_at', $date->month)
                                ->whereYear('created_at', $date->year)
                                ->count(),
                    'likes' => IdeaLikes::whereMonth('created_at', $date->month)
                                ->whereYear('created_at', $date->year)
                                ->count(),
                    'comments' => IdeaComment::whereMonth('created_at', $date->month)
                                ->whereYear('created_at', $date->year)
                                ->count()
                ];
            })
        ];

        // Get schemes statistics with monthly trends
        $schemesStats = [
            'total' => Scheme::count(),
            'monthly' => Scheme::whereMonth('created_at', now()->month)->count(),
            'recent' => Scheme::with('user')
                        ->latest()
                        ->take(5)
                        ->get(),
            'monthly_trends' => collect(range(5, 0))->map(function($months) {
                $date = now()->subMonths($months);
                return [
                    'month' => $date->format('M'),
                    'schemes' => Scheme::whereMonth('created_at', $date->month)
                                    ->whereYear('created_at', $date->year)
                                    ->count()
                ];
            })
        ];

        // Enhanced user engagement metrics
        $userEngagement = [
            'total_users' => User::count(),
            'active_users' => User::whereHas('ideas', function($query) {
                $query->whereMonth('created_at', now()->month);
            })->count(),
            'total_likes' => IdeaLikes::count(),
            'total_comments' => IdeaComment::count(),
            'top_users' => User::withCount(['ideas'])
                ->withCount(['ideas as interactions_count' => function($query) {
                    $query->select(DB::raw('COALESCE(SUM(likes_count + comments_count), 0)'))
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year);
                }])
                ->whereHas('ideas', function($query) {
                    $query->whereMonth('created_at', now()->month);
                })
                ->orderBy('interactions_count', 'desc')
                ->take(5)
                ->get()
                ->map(function($user) {
                    $user->schemes_count = Scheme::where('user_id', $user->id)->count();
                    $user->is_active = true;
                    return $user;
                })
        ];

        // Format category data for the chart
        $categories = Idea::select('category', DB::raw('count(*) as count'))
            ->whereNotNull('category')
            ->groupBy('category')
            ->get();

        $categoryStats = [
            'labels' => $categories->pluck('category')->toArray(),
            'data' => $categories->pluck('count')->toArray()
        ];

        return view('analytics.index', compact('ideasStats', 'schemesStats', 'userEngagement', 'categoryStats'));
    }
} 