<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\Bus;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $buses = Bus::all(); // loop over all buses

        foreach ($buses as $bus) {
            $seatNumbers = ['A1', 'A2', 'A3', 'A4', 'A5','A6',  'B1', 'B2', 'B3', 'B4','B5', 'B6'];

            foreach ($seatNumbers as $seatNumber) {
                Seat::create([
                    'bus_id' => $bus->id,
                    'seat_number' => $seatNumber,
                    'status' => 'available',
                ]);
            }
        }
    }
}
