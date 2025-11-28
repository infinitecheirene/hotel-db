<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Rooms;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return response()->json($rooms);
    }
}