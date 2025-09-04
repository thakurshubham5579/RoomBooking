<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Http\Requests\RoomRequest;
use Illuminate\Support\Facades\Auth;

class OwnerRoomController extends Controller
{
    public function index($hotelId)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($hotelId);

        $rooms = $hotel->rooms;

        return view('owner.hotels.rooms.index', compact('hotel', 'rooms'));
    }

    public function create()
{
    // Get all hotels of the logged-in owner
    $hotels = Hotel::whereHas('owners', function ($q) {
        $q->where('user_id', Auth::id());
    })->get();

    return view('owner.hotels.rooms.create', compact('hotels'));
}


public function store(Request $request)
{
    $hotel = Hotel::whereHas('owners', function ($q) {
        $q->where('user_id', Auth::id());
    })->findOrFail($request->hotel_id);

    $request->validate([
        'room_number' => 'required|unique:rooms,room_number,NULL,id,hotel_id,' . $hotel->id,
        'type' => 'required',
        'price' => 'required|numeric',
        'status' => 'required',
        'description' => 'nullable',
    ]);

    $hotel->rooms()->create($request->only('room_number', 'type', 'price', 'status', 'description'));

    return redirect()->route('owner.hotels.rooms.index', $hotel->id)->with('success', 'Room added successfully.');
}



    public function show($hotelId, $id)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($hotelId);

        $room = $hotel->rooms()->findOrFail($id);

        return view('owner.hotels.rooms.show', compact('hotel', 'room'));
    }

    public function edit($hotelId, $id)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($hotelId);

        $room = $hotel->rooms()->findOrFail($id);

        return view('owner.hotels.rooms.edit', compact('hotel', 'room'));
    }

   public function update(Request $request, Hotel $hotel, Room $room)
{
    $validated = $request->validate([
        'room_number' => 'required',
        'type' => 'required',
        'price' => 'required|numeric',
        'status' => 'required',
        'description' => 'nullable',
    ]);

    $room->update($validated);

    return redirect()->route('owner.hotels.rooms.index', $hotel->id)
                     ->with('success', 'Room updated successfully!');
}


    public function destroy($hotelId, $id)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($hotelId);

        $room = $hotel->rooms()->findOrFail($id);
        $room->delete();

        return redirect()->route('owner.hotels.rooms.index', $hotel->id)
                         ->with('success', 'Room deleted successfully.');
    }
}
