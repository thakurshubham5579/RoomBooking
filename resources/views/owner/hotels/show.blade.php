@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $hotel->name }}</h1>

    <div class="bg-white p-6 rounded-xl shadow-md mb-6">
        <h2 class="text-xl font-semibold">Hotel Details</h2>
        <p><strong>Location:</strong> {{ $hotel->location ?? 'Not specified' }}</p>
        <p><strong>Description:</strong> {{ $hotel->description ?? 'No description available.' }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-4">Rooms</h2>

        @if($hotel->rooms->isEmpty())
            <p class="text-gray-500">No rooms available for this hotel.</p>
        @else
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Room Number</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Bookings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotel->rooms as $room)
                        <tr>
                            <td class="px-4 py-2 border">{{ $room->room_number }}</td>
                            <td class="px-4 py-2 border">{{ $room->type }}</td>
                            <td class="px-4 py-2 border">₹{{ number_format($room->price, 2) }}</td>
                            <td class="px-4 py-2 border">
                                {{ $room->bookings->count() }} bookings
                                <a href="{{ route('owner.bookings.index', ['room' => $room->id]) }}" class="text-blue-500 hover:underline ml-2">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('owner.hotels.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">← Back to Hotels</a>
    </div>
</div>
@endsection
