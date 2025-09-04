{{-- resources/views/owner/dashboard.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}!</h1>
    <p class="mt-2 text-gray-600">This is your Owner Dashboard.</p>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-lg font-semibold">My Hotels</h2>
            <p class="text-gray-600">Manage your hotels and add rooms.</p>
            <a href="{{ route('owner.hotels.index') }}" class="text-blue-600 hover:underline">Go to Hotels</a>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-lg font-semibold">Bookings</h2>
            <p class="text-gray-600">See bookings related to your hotels.</p>
            <a href="{{ route('owner.bookings.index') }}" class="text-blue-600 hover:underline">View Bookings</a>
        </div>
    </div>
</div>
@endsection
