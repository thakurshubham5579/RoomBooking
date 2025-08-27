@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Bookings</h1>

    @if($bookings->isEmpty())
        <p class="text-gray-600">No bookings found.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">User</th>
                    <th class="border px-4 py-2">Hotel</th>
                    <th class="border px-4 py-2">Room</th>
                    <th class="border px-4 py-2">Check-in</th>
                    <th class="border px-4 py-2">Check-out</th>
                    <th class="border px-4 py-2">Guests</th>
                    <th class="border px-4 py-2">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td class="border px-4 py-2">{{ $booking->id }}</td>
                    <td class="border px-4 py-2">{{ $booking->user->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $booking->room->hotel->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $booking->room->room_number }}</td>
                    <td class="border px-4 py-2">{{ $booking->check_in }}</td>
                    <td class="border px-4 py-2">{{ $booking->check_out }}</td>
                    <td class="border px-4 py-2">{{ $booking->guests }}</td>
                    <td class="border px-4 py-2">{{ $booking->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
