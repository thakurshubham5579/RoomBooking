<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

       public function index()
    {
        $bookings = Booking::with(['room.hotel', 'user'])->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }
    
    // User: book a room
    public function store(Request $request, $room_id)
    {
        $room = Room::findOrFail($room_id);

        $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Ensure room is available
        if ($room->status === 'booked') {
            return back()->with('error', 'This room is already booked.');
        }

        Booking::create([
            'user_id'   => Auth::id(),
            'room_id'   => $room->id,
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'status'    => 'confirmed',
        ]);

        // Mark room as booked
        $room->update(['status' => 'booked']);

        return redirect('/my-bookings')->with('success', 'Room booked successfully');
    }

    // User: view own bookings
    public function myBookings()
    {
        $bookings = Booking::with('room.hotel')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.my_bookings', compact('bookings'));
    }

    // Admin: view all bookings
    public function allBookings()
    {
        $bookings = Booking::with('user','room.hotel')->latest()->get();
        return view('bookings.all_bookings', compact('bookings'));
    }

    // User/Admin: cancel booking
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::id() !== $booking->user_id && !Auth::user()->IsAdmin::class()) {
            abort(403, 'Unauthorized');
        }

        $booking->update(['status' => 'cancelled']);

        // Mark room available again
        $booking->room->update(['status' => 'available']);

        return back()->with('success', 'Booking cancelled');
    }
}
