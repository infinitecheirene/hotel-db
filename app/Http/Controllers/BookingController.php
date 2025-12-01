<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request){
        return Bookings::create([
            'room_id' => $request->room_id,
            'room_name' => $request->room_name,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guest_no' => $request->guest_no,
            'night_no' => $request->night_no,
            'total_amount' => $request->total_amount,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'special_requests' => $request->special_requests,
            'user_id' => auth()->id(), // Important
        ]);

        $booking = Bookings::create($validated);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking
        ], 201);
    }
}
