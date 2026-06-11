<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class KhaltiPaymentController extends Controller
{
    public function purchase(Request $request, $bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            $totalAmount = $request->total_price * 100;

            $payload = [
                "return_url" => url('/verify-payment') . '?booking_id=' . $booking->id,
                "website_url" => url('/'),
                "amount" => $totalAmount,
                "purchase_order_id" => $booking->id,
                "purchase_order_name" => "Futsal Booking #" . $booking->id,
                "customer_info" => [
                    "name" => auth()->user()->name,
                    "email" => auth()->user()->email ?? 'user@email.com',
                    "phone" => auth()->user()->phone ?? "9800000000"
                ]
            ];

            // Make the API call to Khalti to initiate the payment
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'key ' . env('KHALTI_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', $payload);

            Log::info('Khalti Response:', $response->json());

            if ($response->successful() && isset($response['payment_url'])) {
                return response()->json(['khalti_url' => $response['payment_url']]);
            }

            return response()->json(['error' => 'Failed to initiate Khalti payment.'], 500);
        } catch (\Throwable $e) {
            Log::error('Khalti Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $bookingId = $request->query('booking_id');
        $booking = Booking::find($bookingId);

        if (!$booking) {
            Log::error('Booking not found during verifyPayment. Booking ID: ' . $bookingId);
            return redirect()->route('booking.index')->with('error', 'Booking not found.');
        }

        DB::beginTransaction();
        try {

            $paymentStatus = 'paid'; // Set as 'paid' if the payment is confirmed

            if ($paymentStatus === 'paid') {
                $booking->update([
                    'status' => 'confirmed',  // Confirm the booking status
                    'payment_status' => 'paid', // Payment status
                ]);


                DB::commit();
                Log::info("Booking confirmed and payment completed for booking ID: $bookingId");

                return redirect()->route('booking.confirmation', $booking->id)
                    ->with('success', 'Your booking has been confirmed and payment completed!');
            } else {
                // Handle failure
                $booking->update([
                    'status' => 'failed',  // Mark the booking as failed
                    'payment_status' => 'failed', // Payment failed status
                ]);

                DB::commit();
                Log::error("Booking payment failed for booking ID: $bookingId");

                return redirect()->route('booking.index')->with('error', 'Payment failed. Please try again.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment verification transaction failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Booking could not be completed.');
        }
    }
}
