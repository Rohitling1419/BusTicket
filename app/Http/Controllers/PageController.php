<?php

namespace App\Http\Controllers;  

use Illuminate\Http\Request;
use App\Models\Post;  
use App\Models\Contact; 
use App\Models\Bus;
use App\Models\City;


class PageController extends Controller 
{
    public function home()
    {
        $cities = City::orderBy('name')->pluck('name');
        return view('pages.home', compact('cities'));
    }
    

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function blog()
    {
        // Fetch all blog posts from the database
        $posts = Post::all();  

        // Pass the posts to the view
        return view('pages.blog', compact('posts'));
    }

    public function showBlog($id)
{
    $post = Post::findOrFail($id);
    return view('pages.single_blog', compact('post'));
}

    public function search(Request $request)
    {
        
        $request->validate([
            'from' => 'nullable|string|min:2',
            'to' => 'nullable|string|min:2',
            'date' => 'nullable|date',
        ]);
    
        // Fetch valid locations
        $validFromLocations = Bus::pluck('from_location')->map(fn($loc) => strtolower(trim($loc)))->unique();
        $validToLocations = Bus::pluck('to_location')->map(fn($loc) => strtolower(trim($loc)))->unique();
    
        // Normalize input
        $fromInput = strtolower(trim($request->input('from')));
        $toInput = strtolower(trim($request->input('to')));
    
        // Check if inputs are valid
        if ($fromInput && !$validFromLocations->contains($fromInput)) {
            return redirect()->back()->withInput()->with('error', 'Invalid "From" location entered.');
        }
    
        if ($toInput && !$validToLocations->contains($toInput)) {
            return redirect()->back()->withInput()->with('error', 'Invalid "To" location entered.');
        }
    
        // Start query
        $query = Bus::query();
    
        if ($fromInput) {
            $query->whereRaw('LOWER(from_location) = ?', [$fromInput]);
        }
    
        if ($toInput) {
            $query->whereRaw('LOWER(to_location) = ?', [$toInput]);
        }
    
        if ($request->filled('bus_type')) {
            $query->where('bus_type', $request->bus_type);
        }
    
        if ($request->filled('date')) {
            $query->whereDate('departure_date', $request->date);
        }
    
        $buses = $query->get();
    
        if ($buses->isEmpty()) {
            return view('pages.search_results', compact('buses'))
                ->with('error', 'No buses found matching your search criteria.');
        }
    
        return view('pages.search_results', compact('buses'));
    }
    
    
    
    public function submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the data to the database
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Redirect with a success message
        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }
}
