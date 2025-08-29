@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $hotels->name }}</h1>

    <h2 class="text-2xl font-bold mb-4">Rooms by Type</h2>

    @if($hotels->rooms->isEmpty())
        <p class="text-gray-500">No rooms available for this hotel.</p>
    @else
        {{-- Group rooms by type --}}
        @foreach($hotels->rooms->groupBy('type') as $type => $rooms)
            <h3 class="text-xl font-semibold mb-4 mt-6">{{ ucfirst($type) }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                    <div class="border rounded-xl shadow-lg p-4 bg-white hover:shadow-2xl transition">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-lg font-bold">Room {{ $room->room_number }}</h4>
                            <span class="px-3 py-1 text-sm rounded text-white 
                                {{ $room->status === 'booked' ? 'bg-red-500' : 'bg-green-500' }}">
                                {{ ucfirst($room->status) }}
                            </span>
                        </div>

                        <p class="text-gray-600 mb-2">₹{{ $room->price }}/night</p>

                        <div class="mt-3">
                          @if($room->status === 'available')
    <form action="{{ route('public.booking.my_bookings', $room->id) }}" method="POST">
        @csrf
        <button type="submit" 
            class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Book Now
        </button>
    </form>
@else
    <button class="block w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed" disabled>
        Not Available
    </button>
@endif

                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif

    <div class="mt-6">
        <a href="{{ route('public.hotels.index') }}" 
           class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            Back to Hotels
        </a>
    </div>
</div>
@endsection

