<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Admin Booking History
    public function history()
    {
        // Fetch all bookings with user and bus information, paginate results
        $bookings = Booking::with(['user', 'bus'])->latest()->paginate(10);

        // Return the view with bookings data for the admin
        return view('admin.booking', compact('bookings'));
    }

    // User Booking History (view their own bookings)
    public function userBookingHistory()
    {
        // Fetch bookings of the authenticated user, with bus information, and paginate
        $bookings = Booking::where('user_id', auth()->id())->with('bus')->latest()->paginate(10);

        // Return the view with the user's booking data
        return view('pages.booking_history', compact('bookings'));
    }

    // Handle booking submission
    public function bookingsubmit(Request $request)
    {
        // dd($request);
        // 1. Validate input
        $data = $request->validate([
            'bus_id'         => ['required', 'exists:buses,id'],
            'boarding_point' => ['required', 'string'],
            'selected_seats' => ['required', 'string'],
            'total_amount'   => ['required', 'numeric'],
        ]);

        // 2. Fetch the bus
        $bus = Bus::findOrFail($data['bus_id']);

        // 3. Optionally check seat availability
        $requestedSeats = explode(',', $data['selected_seats']);
        $alreadyBooked = Booking::where('bus_id', $bus->id)
            ->where('status', 'confirmed')
            ->pluck('seat_number')
            ->flatMap(function ($seatsJson) {
                return explode(',', $seatsJson);
            })
            ->toArray();

        // Ensure none of the requested seats are already booked
        foreach ($requestedSeats as $seat) {
            if (in_array($seat, $alreadyBooked)) {
                return back()
                    ->withErrors(['selected_seats' => "Seat {$seat} is no longer available."])
                    ->withInput();
            }
        }

        // 4. Create booking
        $booking = Booking::create([
            'user_id'      => Auth::id(),
            'bus_id'       => $bus->id,
            'booking_date' => Carbon::now(),                // store current timestamp
            'seat_number'  => $data['selected_seats'],     // store as comma-separated
            'status'       => 'pending',
        ]);

        // 5. Optionally decrement seat count on bus
        $bus->decrement('available_seats', count($requestedSeats));
        $total_amount = $request->total_amount;
        // 6. Redirect with success
        return view('pages.khalti_payment', compact('booking', 'total_amount'));
    }

    // Cancel Booking (for users)
    public function cancel($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Check if the authenticated user is the one who made the booking
        if ($booking->user_id != auth()->id()) {
            return redirect()->route('user.booking.history')->with('error', 'You do not have permission to cancel this booking.');
        }

        // Check if the booking is already cancelled
        if ($booking->status == 'cancelled') {
            return redirect()->route('user.booking.history')->with('error', 'This booking is already cancelled.');
        }

        // Update the booking status to 'cancelled'
        $booking->status = 'cancelled';
        $booking->save();

        // Optionally increment the available seats on the bus
        $bus = $booking->bus;
        $seatsBooked = explode(',', $booking->seats_booked);
        $bus->increment('available_seats', count($seatsBooked));

        // Redirect back to the booking history with a success message
        return redirect()->route('user.booking.history')->with('success', 'Booking has been successfully cancelled.');
    }

    // Show Booking Confirmation (for users)
    public function showConfirmation($bookingId)
    {
        // Retrieve booking data by booking ID
        $booking = Booking::with(['bus', 'seats'])->findOrFail($bookingId);

        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            return redirect()->route('user.booking.history')->with('error', 'You do not have access to view this booking.');
        }

        // Return the confirmation view with the booking data
        return view('booking.confirmation', compact('booking'));
    }
}
