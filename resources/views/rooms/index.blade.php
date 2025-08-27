@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Available Rooms</h1>

    @if($rooms->isEmpty())
        <p class="text-gray-600">No rooms available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($rooms as $room)
            <div class="border rounded-lg shadow-md p-4 bg-white">
                <h2 class="text-xl font-semibold">Room {{ $room->room_number }}</h2>
                <p class="text-gray-600">{{ $room->type }}</p>
                <p class="text-gray-800 font-bold">₹{{ $room->price }} / night</p>
                <p class="text-sm text-gray-500">Status: {{ ucfirst($room->status) }}</p>

                <a href="{{ route('rooms.show', $room->id) }}" 
                   class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                   View Details
                </a>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
