<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bus extends Model
{
    protected $fillable = [
        'bus_name', 'from_location', 'to_location', 
        'departure_date', 'departure_time', 'arrival_time', 
        'available_seats', 'bus_type', 'arrival_date','price'
    ];    
    
}
