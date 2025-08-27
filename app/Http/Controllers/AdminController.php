<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $hotelsCount   = Hotel::count();
        $roomsCount    = Room::count();
        $bookingsCount = Booking::count();

        $latestBookings = Booking::with(['room.hotel', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'hotelsCount',
            'roomsCount',
            'bookingsCount',
            'latestBookings'
        ));
    }

    /**
     * Show all hotels (for admin management).
     */
    public function hotels()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('admin.hotels', compact('hotels'));
    }

    /**
     * Show all rooms (for admin management).
     */
    public function rooms()
    {
        $rooms = Room::with('hotel')->latest()->paginate(10);
        return view('admin.rooms', compact('rooms'));
    }

    /**
     * Show all bookings (for admin management).
     */
    public function bookings()
    {
        $bookings = Booking::with(['room.hotel', 'user'])->latest()->paginate(10);
        return view('bookings.all_bookings', compact('bookings'));
    }
}

