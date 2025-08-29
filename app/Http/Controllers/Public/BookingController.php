<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show user’s bookings
    public function myBookings()
    {
        $bookings = Booking::with('room.hotel')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('public.bookings.my_bookings', compact('bookings'));
    }

    // Book a room
    public function book(Request $request, Room $room)
    {
        if ($room->status === 'booked') {
            return back()->with('error', 'Room is already booked.');
        }

        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        // Mark room as booked
        $room->status = 'booked';
        $room->save();

        // Create booking
        Booking::create([
            'user_id'   => Auth::id(),
            'room_id'   => $room->id,
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'guests'    => $request->guests,
            'status'    => 'booked',
        ]);

        return redirect()->route('public.booking.my')
            ->with('success', 'Room booked successfully!');
    }

    // Cancel booking by user
    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        // Free the room again
        $booking->room->status = 'available';
        $booking->room->save();

        return back()->with('success', 'Booking cancelled.');
    }
}
