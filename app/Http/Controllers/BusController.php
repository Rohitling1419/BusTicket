<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\User;
use App\Models\City;
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
        
        // Create a new bus entry in the database
        Bus::create($request->all());
    
        // Get the updated count of buses, users, and cities
        $numBuses = Bus::count();
        $numUsers = User::count();
        $numCities = City::count();  // Assuming you have a City model
    
        // Redirect to the dashboard with the updated counts
        return redirect()->route('admin.dashboard')->with([
            'numBuses' => $numBuses, 
            'numUsers' => $numUsers, 
            'numCities' => $numCities
        ]);
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
            'price' => 'required|numeric|min:0', 
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

}