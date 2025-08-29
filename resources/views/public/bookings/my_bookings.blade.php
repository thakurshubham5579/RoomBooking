@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

    @if($bookings->isEmpty())
        <p class="text-gray-500">You have no bookings yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookings as $booking)
                <div class="border rounded-xl shadow-lg p-4 bg-white hover:shadow-2xl transition">
                    <h2 class="text-xl font-semibold mb-2">
                        {{ $booking->room->hotel->name }}
                    </h2>

                    <p class="text-gray-600">Room Number: {{ $booking->room->room_number }}</p>
                    <p class="text-gray-600">Type: {{ ucfirst($booking->room->type) }}</p>
                    <p class="text-gray-600">Price: ₹{{ $booking->room->price }}/night</p>
                    <p class="text-sm mt-2">
                        Status: 
                        <span class="px-2 py-1 rounded text-white 
                            {{ $booking->room->status === 'booked' ? 'bg-red-500' : 'bg-green-500' }}">
                            {{ ucfirst($booking->room->status) }}
                        </span>
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
