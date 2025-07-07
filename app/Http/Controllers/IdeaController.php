<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    // Method to render the idea submission form
    public function create()
    {
        return view('ideas.create');  // View where Entrepreneur submits ideas
    }

    // Method to handle the idea submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
        ]);

        $idea = Idea::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Idea submitted successfully!');
    }

    public function show(Idea $idea)
    {
        $idea->incrementViews();
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);
        return view('ideas.edit', compact('idea'));
    }

    public function update(Request $request, Idea $idea)
    {
        $this->authorize('update', $idea);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
        ]);

        $idea->update($validated);

        return redirect()->route('dashboard')->with('success', 'Idea updated successfully!');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully!');
    }

    public function toggleLike(Idea $idea)
    {
        $user = auth()->user();
        $like = $idea->likes()->where('user_id', $user->id)->first();
        
        if ($like) {
            $like->delete();
            $idea->decrement('likes_count');
            $liked = false;
        } else {
            $idea->likes()->create(['user_id' => $user->id]);
            $idea->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $idea->likes_count
        ]);
    }

    public function comment(Request $request, Idea $idea)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = $idea->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $validated['comment']
        ]);

        // Update the comments count
        $idea->incrementCommentsCount();
        
        // Refresh the idea to get the updated count
        $idea->refresh();

        // Load the user relationship for the response
        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => [
                    'name' => $comment->user->name,
                ]
            ],
            'comments_count' => $idea->comments_count
        ]);
    }

    public function browse(Request $request)
    {
        $query = Idea::with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments']);

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter by search term if provided
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort options
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'discussed':
                $query->orderBy('comments_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $ideas = $query->paginate(12);
        $categories = Idea::select('category')->distinct()->pluck('category');

        return view('ideas.browse', compact('ideas', 'categories'));
    }
}
