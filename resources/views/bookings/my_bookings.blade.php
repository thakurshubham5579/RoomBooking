@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

    @if($bookings->isEmpty())
        <p>You have no bookings yet.</p>
    @else
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Hotel</th>
                    <th class="p-2">Room</th>
                    <th class="p-2">Check In</th>
                    <th class="p-2">Check Out</th>
                    <th class="p-2">Guests</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td class="p-2">{{ $booking->room->hotel->name }}</td>
                    <td class="p-2">{{ $booking->room->room_number }} ({{ $booking->room->type }})</td>
                    <td class="p-2">{{ $booking->check_in }}</td>
                    <td class="p-2">{{ $booking->check_out }}</td>
                    <td class="p-2">{{ $booking->guests }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
