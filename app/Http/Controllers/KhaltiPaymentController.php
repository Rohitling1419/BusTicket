<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KhaltiPaymentController extends Controller
{
    public function purchase(Request $request)
    {
        try {
            // Step 1: Validate incoming data from booking form
            $data = $request->validate([
                'bus_id' => 'required|exists:buses,id',
                'boarding_point' => 'required|string',
                'selected_seats' => 'required|string',
                'total_amount' => 'required|numeric',
            ]);

            // Step 2: Create booking first (with pending status)
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'bus_id' => $data['bus_id'],
                'booking_date' => now(),
                'seats_booked' => $data['selected_seats'],
                'status' => 'pending',
            ]);

            $amountInPaisa = $data['total_amount'] * 100;
            $bus = Bus::find($data['bus_id']);

            $payload = [
                "return_url" => url('/verify-payment'),
                "website_url" => url('/'),
                "amount" => $amountInPaisa,
                "purchase_order_id" => $booking->id,
                "purchase_order_name" => $bus->bus_name,
                "customer_info" => [
                    "name" => auth()->user()->name ?? 'User',
                    "email" => auth()->user()->email ?? 'user@email.com',
                    "phone" => "9800000000" // dummy for dev mode
                ]
            ];

            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'key ' . env('KHALTI_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', $payload);

            if ($response->successful()) {
                return response()->json(['khalti_url' => $response['payment_url']]);
            }

            return response()->json(['error' => 'Failed to initiate Khalti payment.'], 500);
        } catch (\Exception $e) {
            Log::error("Khalti Payment Error: " . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $token = $request->input('token');
        $amount = $request->input('amount');
        $bookingId = $request->input('purchase_order_id');

        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'key ' . env('KHALTI_SECRET_KEY')
        ])->post('https://khalti.com/api/v2/payment/verify/', [
            'token' => $token,
            'amount' => $amount
        ]);

        if ($response->successful()) {
            $data = $response->json();

            $booking = Booking::findOrFail($bookingId);
            $booking->status = 'paid';
            $booking->save();

            return redirect()->route('booking.success')->with('success', 'Payment successful and booking confirmed.');
        }

        return redirect()->route('booking.failed')->with('error', 'Payment verification failed.');
    }
}