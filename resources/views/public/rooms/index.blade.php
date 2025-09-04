@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Room #{{ $room->room_number }}</h1>
    <p class="mb-2"><strong>Hotel:</strong> {{ $hotel->name }}</p>
    <p class="mb-2"><strong>Location:</strong> {{ $hotel->location }}</p>
    <p class="mb-2"><strong>Type:</strong> {{ ucfirst($room->type) }}</p>
    <p class="mb-2"><strong>Price:</strong> ₹{{ number_format($room->price, 2) }}</p>
    <p class="mb-2"><strong>Status:</strong>
        <span class="{{ $room->status === 'available' ? 'text-green-600' : 'text-red-600' }}">
            {{ ucfirst($room->status) }}
        </span>
    </p>

    <p class="mb-6"><strong>Description:</strong> {{ $room->description }}</p>

    {{-- Buttons --}}
    @if($room->status === 'available')
        <form action="{{ route('public.bookings.book_room', $room->id) }}" method="POST" class="inline-block">
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

    <a href="{{ url()->previous() }}" 
       class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Back
    </a>
</div>
@endsection

