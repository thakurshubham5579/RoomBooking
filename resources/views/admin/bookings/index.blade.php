@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Bookings (Admin)</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <p class="text-gray-500">No bookings found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookings as $booking)
                <div class="border rounded-xl shadow-lg p-4 bg-white hover:shadow-2xl transition">
                    <h2 class="text-xl font-semibold mb-2">
                        {{ $booking->room->hotel->name }}
                    </h2>

                    <p class="text-gray-600">Booked By: <strong>{{ $booking->user->name }}</strong></p>
                    <p class="text-gray-600">Email: {{ $booking->user->email }}</p>

                    <p class="text-gray-600">Room Number: {{ $booking->room->room_number }}</p>
                    <p class="text-gray-600">Type: {{ ucfirst($booking->room->type) }}</p>
                    <p class="text-gray-600">Price: ₹{{ $booking->room->price }}/night</p>
                    <p class="text-gray-600">Check-in: {{ $booking->check_in }}</p>
                    <p class="text-gray-600">Check-out: {{ $booking->check_out }}</p>

                    <p class="text-sm mt-2">
                        Booking Status: 
                        <span class="px-2 py-1 rounded text-white 
                            {{ $booking->status === 'approved' ? 'bg-green-500' : ($booking->status === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </p>

                    {{-- Cancel button only if not cancelled --}}
                    @if($booking->status !== 'cancelled')
                        <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                onclick="return confirm('Are you sure you want to cancel this booking?')"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                Cancel Booking
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
