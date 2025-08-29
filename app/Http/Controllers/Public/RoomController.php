<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function show(Room $room)
    {
        return view('public.rooms.show', compact('room'));
    }
}
