<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\User;
use App\Models\City;

class AdminController extends Controller
{
    public function dashboard()
    {
        $numBuses = Bus::count();
        $numUsers = User::where('is_admin', false)->count(); // only regular users
        $numCities = City::count();
    
        return view('admin.dashboard', compact('numBuses', 'numUsers', 'numCities'));
    }
}
