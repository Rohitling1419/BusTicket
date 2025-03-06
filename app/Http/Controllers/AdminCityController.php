<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class AdminCityController extends Controller
{
    // Show all cities
    public function index(Request $request)
    {
        // Search functionality
        $search = $request->input('search');
        $cities = City::when($search, function ($query) use ($search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->orderBy('name', 'asc')->get();

        return view('admin.cities.index', compact('cities'));
    }

    // Show the create city form
    public function create()
    {
        return view('admin.cities.create');
    }

    // Store the new city
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities,name|max:255'
        ], [
            'name.required' => 'The city name is required.',
            'name.unique' => 'This city already exists.',
            'name.max' => 'City name should not exceed 255 characters.'
        ]);

        City::create(['name' => $request->name]);

        return redirect()->route('admin.cities.index')->with('success', 'City added successfully!');
    }

    // Show the edit city form
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit', compact('city'));
    }

    // Update city details
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:cities,name,' . $id . '|max:255'
        ], [
            'name.required' => 'The city name is required.',
            'name.unique' => 'This city already exists.',
            'name.max' => 'City name should not exceed 255 characters.'
        ]);

        $city = City::findOrFail($id);
        $city->update(['name' => $request->name]);

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully!');
    }

    // Delete a city
    public function destroy($id)
    {
        try {
            $city = City::findOrFail($id);
            $city->delete();

            return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.cities.index')->with('error', 'Failed to delete city. It may be in use.');
        }
    }
}
