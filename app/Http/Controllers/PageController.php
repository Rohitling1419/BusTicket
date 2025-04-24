<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Bus;
use App\Models\City;
use App\Models\Booking; // Add the correct use statement for the Booking model
// Correct the BookingController reference
use App\Http\Controllers\BookingController;

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
        $posts = Post::all();
        return view('pages.blog', compact('posts'));
    }

    public function showBlog($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.single_blog', compact('post'));
    }

    // Search for buses based on user input
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'nullable|string|min:2',
            'to' => 'nullable|string|min:2',
            'date' => 'nullable|date',
        ]);
    
        $fromInput = $request->input('from');
        $toInput = $request->input('to');
        $dateInput = $request->input('date');
    
        $cities = City::orderBy('name')->pluck('name');
    
        // Normalize and validate locations
        $validFromLocations = Bus::pluck('from_location')->map(fn($loc) => strtolower(trim($loc)))->unique();
        $validToLocations = Bus::pluck('to_location')->map(fn($loc) => strtolower(trim($loc)))->unique();
    
        $errors = [];
    
        if ($fromInput && !$validFromLocations->contains(strtolower(trim($fromInput)))) {
            $errors[] = 'Invalid "From" location entered.';
        }
    
        if ($toInput && !$validToLocations->contains(strtolower(trim($toInput)))) {
            $errors[] = 'Invalid "To" location entered.';
        }
    
        if (!empty($errors)) {
            return view('pages.search_results', [
                'buses' => collect(), // empty collection
                'from' => $fromInput,
                'to' => $toInput,
                'date' => $dateInput,
                'cities' => $cities,
                'error' => implode(' ', $errors),
            ]);
        }
    
        // Build query to fetch buses based on input
        $query = Bus::query();
    
        if ($fromInput) {
            $query->whereRaw('LOWER(from_location) = ?', [strtolower($fromInput)]);
        }
    
        if ($toInput) {
            $query->whereRaw('LOWER(to_location) = ?', [strtolower($toInput)]);
        }
    
        if ($request->filled('bus_type')) {
            $query->where('bus_type', $request->bus_type);
        }
    
        if ($dateInput) {
            $query->whereDate('departure_date', $dateInput);
        }
    
        $buses = $query->get();
    
        return view('pages.search_results', [
            'buses' => $buses,
            'from' => $fromInput,
            'to' => $toInput,
            'date' => $dateInput,
            'error' => $buses->isEmpty() ? 'No buses found matching your search criteria.' : null,
            'cities' => $cities,
        ]);
    }

    // Show available seats for a specific bus
    public function viewSeats($busId)
    {
        // Fetch the bus along with its seats
        $bus = Bus::with('seats')->findOrFail($busId);

        // Fetch all the booked seats for the given bus (confirmed bookings)
        $bookedSeats = Booking::where('bus_id', $busId)
                              ->where('status', 'confirmed') // Only confirmed bookings
                              ->pluck('seats_booked'); // Fetch booked seats

        // Split the booked seats into an array, assuming they are stored as comma-separated values
        $bookedSeatsArray = [];
        foreach ($bookedSeats as $seats) {
            $bookedSeatsArray = array_merge($bookedSeatsArray, explode(',', $seats)); // Flatten the array
        }

        // Pass the bus and the booked seats to the view
        return view('pages.view_seats', compact('bus', 'bookedSeatsArray'));
    }

    // Handle passenger details and booking summary before finalizing the booking
    public function passengerDetails(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'selected_seats' => 'required|string', // comma-separated values
            'boarding_point' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $bus = Bus::findOrFail($request->bus_id);
        $selectedSeats = explode(',', $request->selected_seats); // Convert string to array

        return view('pages.passenger_details', [
            'bus' => $bus,
            'selectedSeats' => $selectedSeats,
            'boardingPoint' => $request->boarding_point,
            'totalAmount' => $request->total_amount,
        ]);
    }

    // Handle the form submission from the contact page
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }
}
