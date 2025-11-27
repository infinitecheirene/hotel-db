<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by availability
        if ($request->has('available')) {
            $query->where('available', $request->available);
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Check availability for specific dates
        if ($request->has('check_in') && $request->has('check_out')) {
            $query->whereDoesntHave('bookings', function ($q) use ($request) {
                $q->where('status', '!=', 'cancelled')
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                            ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                            ->orWhere(function ($q) use ($request) {
                                $q->where('check_in', '<=', $request->check_in)
                                    ->where('check_out', '>=', $request->check_out);
                            });
                    });
            });
        }

        $rooms = $query->paginate(10);

        return response()->json($rooms);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:single,double,suite',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'amenities' => 'required|array',
            'image' => 'required|string',
            'images' => 'nullable|array',
            'available' => 'boolean',
            'max_guests' => 'required|integer|min:1',
            'size' => 'required|integer|min:1',
            'location' => 'nullable|string'
        ]);

        $room = Room::create($validated);

        return response()->json($room, 201);
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string|max:255',
            'type' => 'in:single,double,suite',
            'price' => 'numeric|min:0',
            'description' => 'string',
            'amenities' => 'array',
            'image' => 'string',
            'images' => 'array',
            'available' => 'boolean',
            'max_guests' => 'integer|min:1',
            'size' => 'integer|min:1',
            'location' => 'string'
        ]);

        $room->update($validated);

        return response()->json($room);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json(['message' => 'Room deleted successfully']);
    }

    public function checkAvailability(Request $request, $id)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in'
        ]);

        $room = Room::findOrFail($id);
        $isAvailable = $room->isAvailable($request->check_in, $request->check_out);

        return response()->json([
            'available' => $isAvailable,
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out
        ]);
    }
}