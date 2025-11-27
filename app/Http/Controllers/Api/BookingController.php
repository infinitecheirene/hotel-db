<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['room', 'user']);

        if ($request->user()) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($bookings);
    }

    public function show($id)
    {
        $booking = Booking::with(['room', 'user'])->findOrFail($id);

        // Check if user owns this booking
        if (auth()->user()->id !== $booking->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($booking);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'special_requests' => 'nullable|string'
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Validate guest count
        if ($validated['guests'] > $room->max_guests) {
            return response()->json([
                'message' => "This room can accommodate a maximum of {$room->max_guests} guests."
            ], 422);
        }

        // Check availability
        if (!$room->isAvailable($validated['check_in'], $validated['check_out'])) {
            return response()->json([
                'message' => 'Room is not available for the selected dates.'
            ], 422);
        }

        // Calculate nights and total
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalAmount = $nights * $room->price;

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'room_id' => $validated['room_id'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'nights' => $nights,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'special_requests' => $validated['special_requests'] ?? null,
            'total_amount' => $totalAmount,
            'status' => 'confirmed'
        ]);

        return response()->json($booking->load('room'), 201);
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        // Check if user owns this booking
        if (auth()->user()->id !== $booking->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($booking->status === 'cancelled') {
            return response()->json(['message' => 'Booking already cancelled'], 422);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Booking cancelled successfully',
            'booking' => $booking
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $validated['status']]);

        return response()->json($booking);
    }
}
