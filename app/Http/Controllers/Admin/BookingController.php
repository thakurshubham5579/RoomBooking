<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show all bookings (Admin).
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'room.hotel'])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Cancel a booking (Admin).
     */
    public function cancel($id)
    {
        $booking = Booking::with('room')->findOrFail($id);

        // Update booking status
        $booking->update(['status' => 'cancelled']);

        // Mark the room as available again
        if ($booking->room) {
            $booking->room->update(['status' => 'available']);
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking cancelled successfully');
    }
}
