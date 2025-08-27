@extends('layouts.admin') {{-- Use your admin layout --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold">Hotels</h2>
            <p class="text-gray-600 text-lg">Total: {{ $hotelsCount }}</p>
            <a href="{{ route('admin.hotels.index') }}" class="mt-3 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Manage Hotels
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold">Rooms</h2>
            <p class="text-gray-600 text-lg">Total: {{ $roomsCount }}</p>
            <a href="{{ route('admin.rooms.index') }}" class="mt-3 inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                Manage Rooms
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold">Bookings</h2>
            <p class="text-gray-600 text-lg">Total: {{ $bookingsCount }}</p>
            <a href="{{ route('admin.bookings.index') }}" class="mt-3 inline-block bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">
                View Bookings
            </a>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
        <div class="flex space-x-4">
            <a href="{{ route('admin.hotels.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">+ Add Hotel</a>
            <a href="{{ route('admin.rooms.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">+ Add Room</a>
        </div>
    </div>
</div>
@endsection