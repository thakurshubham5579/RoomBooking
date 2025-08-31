@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $hotels->name }}</h1>
    <p class="mb-6 text-gray-600">{{ $hotels->location }}</p>

    <h2 class="text-2xl font-semibold mb-4">Available Rooms</h2>

    @if($hotels->rooms->isEmpty())
        <p class="text-gray-500">No rooms available for this hotel.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hotels->rooms as $room)
                <div class="border rounded-lg shadow p-4 bg-white">
                    <h3 class="font-bold text-lg mb-2">Room #{{ $room->room_number }}</h3>
                    <p class="mb-2">Type: {{ ucfirst($room->type) }}</p>
                    <p class="mb-2">Price: ₹{{ number_format($room->price, 2) }}</p>
                    <p class="mb-2">Status: 
                        <span class="{{ $room->status === 'available' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </p>

                    @if($room->status === 'available')
                        <form action="{{ route('public.bookings.book_room', $room->id) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Book Now
                            </button>
                        </form>
                    @else
                        <button class="bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                            Already Booked
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

