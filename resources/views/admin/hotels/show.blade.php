

@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $hotels->name }}</h1>

    <p class="text-lg text-gray-700 mb-2">
        <strong>Location:</strong> {{ $hotels->location }}
    </p>
    <p class="text-gray-600 mb-4">
        <strong>Description:</strong> {{ $hotels->description }}
    </p>

    <p class="text-gray-800 font-semibold mb-2">
        Total Rooms: {{ $hotels->rooms->count() }}
    </p>

    <!-- Available Rooms -->
    <button onclick="toggleSection('availableRooms')" 
        class="text-green-700 font-semibold mb-2 underline">
        Available Rooms ({{ $hotels->rooms->where('status', 'available')->count() }})
    </button>
    <div id="availableRooms" class="hidden ml-4 mb-4">
        @forelse($hotels->rooms->where('status', 'available') as $room)
            <p class="text-sm text-gray-700">
                <strong>Room {{ $room->room_number }}</strong> - {{ ucfirst($room->type) }} (₹{{ $room->price }}/night)
            </p>
        @empty
            <p class="text-gray-500">No available rooms.</p>
        @endforelse
    </div>

    <!-- Booked Rooms -->
    <button onclick="toggleSection('bookedRooms')" 
        class="text-red-700 font-semibold mb-6 underline">
        Booked Rooms ({{ $hotels->rooms->where('status', 'booked')->count() }})
    </button>
    <div id="bookedRooms" class="hidden ml-4 mb-6">
        @forelse($hotels->rooms->where('status', 'booked') as $room)
            <p class="text-sm text-gray-700">
                <strong>Room {{ $room->room_number }}</strong> - {{ ucfirst($room->type) }} (₹{{ $room->price }}/night)
            </p>
        @empty
            <p class="text-gray-500">No booked rooms.</p>
        @endforelse
    </div>

    <h2 class="text-2xl font-bold mb-4">Rooms by Category</h2>

    @if($hotels->rooms->isEmpty())
        <p class="text-gray-500">No rooms available for this hotel.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($hotels->rooms->groupBy('type') as $type => $rooms)
                <div class="border rounded-lg shadow-md p-4 bg-white">
                    <h3 class="text-xl font-semibold mb-2">{{ ucfirst($type) }}</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $rooms->count() }} rooms in this category
                    </p>

                    <ul class="space-y-2">
                        @foreach($rooms as $room)
                            <li class="p-2 border rounded bg-gray-50">
                                <strong>Room {{ $room->room_number }}</strong> - 
                                ₹{{ $room->price }}/night 
                                <span class="text-sm text-gray-500">(Status: {{ ucfirst($room->status) }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>


@endsection

