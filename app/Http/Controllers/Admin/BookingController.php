<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
   
    public function index()
    {
        $bookings = Booking::with(['user', 'room.hotel'])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    
        public function cancel($id)
    {
        $booking = Booking::with('room')->findOrFail($id);

        
        $booking->update(['status' => 'cancelled']);

        
        if ($booking->room) {
            $booking->room->update(['status' => 'available']);
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking cancelled successfully');
    }


}
