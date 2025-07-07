<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    // Method to render the scheme posting form
    public function create()
    {
        return view('schemes.create');  // View for Government to post schemes
    }

    // Method to handle the scheme posting
    public function store(Request $request)
    {
        // Validation logic for posting schemes
        $request->validate([
            'scheme' => 'required|string|max:255',
        ]);

        // Store the scheme in the database
        Scheme::create([
            'user_id' => auth()->id(),  // Link scheme to the logged-in user
            'scheme' => $request->input('scheme'),
        ]);

        // Redirect back with a success message
        return redirect()->route('schemes.create')->with('success', 'Scheme posted successfully!');
    }
}
