<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Display all buses with pagination
    public function index()
    {
        $buses = Bus::paginate(10);
        return view('admin.buses.index', compact('buses'));
    }

    // Show the form to create a new bus
    public function create()
    {
        return view('admin.buses.create');
    }

    // Store a new bus
    public function store(Request $request)
    {
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
            'available_seats' => 'required|integer|min:1',
            'bus_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',  // Price validation added here
        ]);

        Bus::create($request->all());

        return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully!');
    }

    // Search for buses based on departure, destination, and date
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $buses = Bus::where('from_location', $request->from)
                    ->where('to_location', $request->to)
                    ->where('departure_date', $request->date)
                    ->paginate(10);

        return view('pages.search_results', compact('buses'));
    }

    // New Filter Function for Advanced Filtering
    public function filter(Request $request)
    {
        $request->validate([
            'bus_type'        => 'nullable|string|max:255',
            'departure_time'  => 'nullable|date_format:H:i',
            'arrival_time'    => 'nullable|date_format:H:i',
            'min_seats'       => 'nullable|integer|min:1',
            'max_price'       => 'nullable|numeric|min:0',  // Added max price filter
        ]);

        // Apply filters dynamically
        $buses = Bus::query()
                    ->when($request->bus_type, function ($query) use ($request) {
                        return $query->where('bus_type', $request->bus_type);
                    })
                    ->when($request->departure_time, function ($query) use ($request) {
                        return $query->where('departure_time', '>=', $request->departure_time);
                    })
                    ->when($request->arrival_time, function ($query) use ($request) {
                        return $query->where('arrival_time', '<=', $request->arrival_time);
                    })
                    ->when($request->min_seats, function ($query) use ($request) {
                        return $query->where('available_seats', '>=', $request->min_seats);
                    })
                    ->when($request->max_price, function ($query) use ($request) {
                        return $query->where('price', '<=', $request->max_price);  // Filter buses by price
                    })
                    ->paginate(10);

        return view('pages.filtered_results', compact('buses'));
    }

    // Show the form to edit an existing bus
    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return view('admin.buses.edit', compact('bus'));
    }

    // Update an existing bus
    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
            'available_seats' => 'required|integer|min:1',
            'bus_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',  // Price validation added here
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update($request->all());

        return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully!');
    }

    // Delete a bus
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully!');
    }
    public function viewSeats($id)
    {
        $bus = Bus::findOrFail($id);
        return view('pages.view_seats', compact('bus'));
    }
    public function passengerDetails(Request $request)
{
    $bus = Bus::findOrFail($request->bus_id);
    $selectedSeats = explode(',', $request->selected_seats); // Convert string back to array
    $boardingPoint = $request->boarding_point;
    $totalAmount = $request->total_amount;

    return view('pages.passenger_details', compact('bus', 'selectedSeats', 'boardingPoint', 'totalAmount'));
}
}
