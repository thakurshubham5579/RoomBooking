<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;

class OwnerHomeController extends Controller
{
    /**
     * Show owner dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Hotels owned by this user
        $hotels = Hotel::whereHas('owners', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();

        // Counts
        $hotelsCount   = $hotels->count();
        $roomsCount    = Room::whereIn('hotel_id', $hotels->pluck('id'))->count();
        $bookingsCount = Booking::whereHas('room.hotel.owners', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        // Latest bookings for owner’s hotels
        $latestBookings = Booking::whereHas('room.hotel.owners', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->with(['room.hotel', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('owner.home', [
    'hotelsCount'   => $hotelsCount,
    'roomsCount'    => $roomsCount,
    'bookingsCount' => $bookingsCount,
    'hotels'       => $hotels, // pass collection
    'hotel'        => $hotels->first(), // pass one hotel (first one)
]);
    }

    /**
     * Show hotels owned by the authenticated owner
     */
    public function hotels()
    {
        $user = Auth::user();

        $hotels = Hotel::whereHas('owners', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->latest()->paginate(10);

        return view('owner.hotels.index', compact('hotels'));
    }

    /**
     * Show rooms under owner’s hotels
     */
    public function rooms()
    {
        $user = Auth::user();

        $rooms = Room::whereHas('hotel.owners', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->with('hotel')
            ->latest()
            ->paginate(10);

        return view('owner.rooms.index', compact('rooms'));
    }

    /**
     * Show bookings for owner’s hotels
     */
    public function bookings()
    {
        $user = Auth::user();

        $bookings = Booking::whereHas('room.hotel.owners', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->with(['room.hotel', 'user'])
            ->latest()
            ->paginate(10);

        return view('owner.bookings.index', compact('bookings'));
    }
}

