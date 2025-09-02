<?php

namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerHotelController extends Controller
{
    public function index()
    {
        // ✅ Show only hotels owned by logged-in owner
        $hotels = Auth::user()->hotels;
        return view('owner.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('owner.hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $hotel = Hotel::create($request->only('name', 'location'));

        // ✅ Attach logged-in user as owner
        $hotel->owners()->attach(Auth::id());

        return redirect()->route('owner.hotels.index')
            ->with('success', 'Hotel created successfully.');
    }

       public function show($id)
    {
        $hotel = Hotel::where('id', $id)
            ->whereHas('owners', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->with('rooms.bookings')
            ->firstOrFail();

        return view('owner.hotels.show', compact('hotel'));
    }

    public function edit($id)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($id);

        return view('owner.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $hotel->update($request->only('name', 'location'));

        return redirect()->route('owner.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy($id)
    {
        $hotel = Hotel::whereHas('owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($id);

        $hotel->delete();

        return redirect()->route('owner.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}

