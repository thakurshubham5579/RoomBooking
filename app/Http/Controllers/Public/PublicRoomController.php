<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class PublicRoomController extends Controller
{
    public function index($hotelId, $roomId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $room = $hotel->rooms()->findOrFail($roomId);

        return view('public.rooms.index', compact('hotel', 'room'));
    }
}
