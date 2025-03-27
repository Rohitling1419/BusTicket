<?php

namespace App\Http\Controllers;  // Use the correct namespace for this controller

use Illuminate\Http\Request;
use App\Models\Post;  // Ensure that the Post model is imported
use App\Models\Contact; // Ensure that the Contact model is imported if you're using it

class PageController extends Controller  // Change `Controllers` to `Controller`
{
    public function home()
    {
        return view('pages.home');
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
        $posts = Post::all();  // Or you can use pagination, depending on how many posts you have

        // Pass the posts to the view
        return view('pages.blog', compact('posts'));
    }

    public function search()
    {
        return view('pages.search');
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
