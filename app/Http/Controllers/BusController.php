<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        // Combine date + time into datetime objects
        $departureDateTime = Carbon::parse($request->departure_date . ' ' . $request->departure_time);
        $arrivalDateTime = Carbon::parse($request->arrival_date . ' ' . $request->arrival_time);

        // Merge into request so we can validate
        $request->merge([
            'departure_datetime' => $departureDateTime,
            'arrival_datetime' => $arrivalDateTime,
        ]);

        // Validate fields
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date',
            'arrival_time' => 'required|date_format:H:i',
            'departure_datetime' => 'required|date',
            'arrival_datetime' => 'required|date|after:departure_datetime',
            'available_seats' => 'required|integer|min:1',
            'bus_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Save bus to DB
        Bus::create($request->all());

        // Dashboard counts
        $numBuses = Bus::count();
        $numUsers = User::count();
        $numCities = City::count();

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
        $departureDateTime = Carbon::parse($request->departure_date . ' ' . $request->departure_time);
        $arrivalDateTime = Carbon::parse($request->arrival_date . ' ' . $request->arrival_time);

        $request->merge([
            'departure_datetime' => $departureDateTime,
            'arrival_datetime' => $arrivalDateTime,
        ]);

        $request->validate([
            'bus_name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date',
            'arrival_time' => 'required|date_format:H:i',
            'departure_datetime' => 'required|date',
            'arrival_datetime' => 'required|date|after:departure_datetime',
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
