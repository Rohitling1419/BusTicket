<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Display all buses
    public function index()
    {
        $buses = Bus::all();
        return view('admin.buses.index', compact('buses'));
    }

    // Show the form to create a new bus
    public function create()
    {
        return view('admin.buses.create');
    }

    // Store the new bus
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'available_seats' => 'required|integer|min:1',
            'bus_type' => 'required|string|max:255',
        ]);

        // Create the bus in the database
        Bus::create([
            'bus_name' => $request->bus_name,
            'from_location' => $request->from_location,
            'to_location' => $request->to_location,
            'departure_date' => $request->departure_date,
            'available_seats' => $request->available_seats,
            'bus_type' => $request->bus_type,
        ]);

        // Redirect to the bus list with a success message
        return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully!');
    }

    // Search for buses
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'date' => 'required|date',
        ]);

        $buses = Bus::where('from_location', $request->from)
                    ->where('to_location', $request->to)
                    ->where('departure_date', $request->date)
                    ->get();

        return view('pages.search_results', compact('buses'));
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
            'available_seats' => 'required|integer|min:1',
            'bus_type' => 'required|string|max:255',
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update([
            'bus_name' => $request->bus_name,
            'from_location' => $request->from_location,
            'to_location' => $request->to_location,
            'departure_date' => $request->departure_date,
            'available_seats' => $request->available_seats,
            'bus_type' => $request->bus_type,
        ]);

        return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully!');
    }

    // Destroy a bus (optional route)
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully!');
    }
}
