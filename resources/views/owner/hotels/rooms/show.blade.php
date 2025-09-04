@extends('layouts.owner')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Room Details</h1>

    <div class="bg-white shadow rounded p-6">
        <p><strong>Hotel:</strong> {{ $hotel->name }}</p>
        <p><strong>Room Number:</strong> {{ $room->room_number }}</p>
        <p><strong>Type:</strong> {{ $room->type }}</p>
        <p><strong>Price:</strong> ₹{{ number_format($room->price, 2) }}</p>
        <p><strong>Status:</strong> 
            <span class="{{ $room->status == 'available' ? 'text-green-600' : 'text-red-600' }}">
                {{ ucfirst($room->status) }}
            </span>
        </p>
        <p><strong>Description:</strong> {{ $room->description ?? 'No description' }}</p>
    </div>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('owner.hotels.rooms.index', $hotel->id) }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            Back to Rooms
        </a>
        <a href="{{ route('owner.hotels.rooms.edit', [$hotel->id, $room->id]) }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Edit Room
        </a>
        <form method="POST" action="{{ route('owner.hotels.rooms.destroy', [$hotel->id, $room->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                    onclick="return confirm('Are you sure you want to delete this room?')">
                Delete Room
            </button>
        </form>
    </div>
</div>
@endsection
