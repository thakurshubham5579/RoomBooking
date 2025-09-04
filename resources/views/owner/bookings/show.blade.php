@extends('layouts.owner')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Booking Details</h1>

    <div class="bg-white shadow rounded-lg p-4">
        <p><strong>ID:</strong> {{ $booking->id }}</p>
        <p><strong>Hotel:</strong> {{ $booking->hotel }}</p>
        <p><strong>Room:</strong> {{ $booking->room->name }}</p>
        <p><strong>User:</strong> {{ $booking->user->name }}</p>
        <p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
        <p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
        <p><strong>Status:</strong> {{ $booking->status }}</p>
    </div>

    <a href="{{ route('owner.bookings.index') }}" class="mt-4 inline-block bg-gray-700 text-white px-4 py-2 rounded">
        Back to Bookings
    </a>
</div>
@endsection
