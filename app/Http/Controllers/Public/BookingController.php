<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show all bookings for the logged-in user
     */
    public function myBookings()
    {
        $bookings = Booking::with('room.hotel')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('public.bookings.my_bookings', compact('bookings'));
    }

public function bookRoom($roomId)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login to book a room.');
    }

    $room = Room::findOrFail($roomId);

    if ($room->status !== 'available') {
        return redirect()->back()->with('error', 'Room is not available for booking.');
    }

    $booking = new Booking();
    $booking->user_id = Auth::id();
    $booking->room_id = $room->id;
    $booking->status = 'confirmed';
    $booking->check_in = now();
    $booking->check_out = now()->addDays(1);
    $booking->save();

    $room->update(['status' => 'booked']);

    return redirect()->route('public.bookings.my_bookings')
                     ->with('success', 'Room booked successfully!');
}

    /**
     * Cancel a booking
     */
   public function cancel($id)
{
    $booking = Booking::where('id', $id)
        ->where('user_id', Auth::id()) // ✅ only cancel own booking
        ->firstOrFail();

    // Update booking status
    if ($booking->status !== 'cancelled') {
        $booking->status = 'cancelled';
        $booking->save();

        // Set room back to available
        if ($booking->room) {
            $booking->room->update(['status' => 'available']);
        }
    }

    return redirect()->route('public.bookings.my_bookings')
                     ->with('success', 'Booking cancelled. Room is now available again.');
}

}
