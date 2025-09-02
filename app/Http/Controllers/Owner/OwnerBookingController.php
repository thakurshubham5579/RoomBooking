<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Hotel;

class OwnerBookingController extends Controller
{
    // Show all bookings for the owner’s hotels
    public function index()
    {
        $bookings = Booking::whereHas('room.hotel.owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('room.hotel', 'user')->get();

        return view('owner.bookings.index', compact('bookings'));
    }

    // Show a single booking details
    public function show($id)
    {
        $booking = Booking::whereHas('room.hotel.owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('room.hotel', 'user')->findOrFail($id);

        return view('owner.bookings.show', compact('booking'));
    }

    // Cancel/delete booking
    public function destroy($id)
    {
        $booking = Booking::whereHas('room.hotel.owners', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($id);

        $booking->delete();

        return redirect()->route('owner.bookings.index')->with('success', 'Booking cancelled successfully.');
    }
}

