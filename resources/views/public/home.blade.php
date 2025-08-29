@extends('layouts.app')

@section('content')
<div class="text-center p-10">
    <h1 class="text-3xl font-bold">Welcome to Room Booking</h1>
    <p class="mt-4 text-gray-600">Browse hotels and book your favorite rooms.</p>

    <a href="{{ route('public.hotels.index') }}" 
       class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
       Browse Hotels
    </a>
</div>
@endsection
