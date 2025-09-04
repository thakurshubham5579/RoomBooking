<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
       public function index()
    {
        $rooms = Room::with('hotel')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

      public function create()
    {
        $hotels = Hotel::all();
        return view('admin.rooms.create', compact('hotels'));
    }

     public function store(RoomRequest $request)
    {
        Room::create($request->validated());

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Room added successfully');
    }

        public function show($id)
    {
        $room = Room::with('hotel')->findOrFail($id);
        return view('admin.rooms.show', compact('rooms'));
    }

     public function edit($id)
    {
        $room = Room::findOrFail($id);
        $hotels = Hotel::all();
        return view('admin.rooms.edit', compact('room', 'hotels'));
    }

      public function update(RoomRequest $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->validated());

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully');
    }

       public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully');
    }
}
  