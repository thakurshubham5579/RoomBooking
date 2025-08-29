@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Room {{ $room->room_number }}</h1>
    <p class="text-gray-600">Type: {{ $room->type }}</p>
    <p class="text-gray-800 font-bold">₹{{ $room->price }} / night</p>
    <p class="text-sm text-gray-500">Status: {{ ucfirst($room->status) }}</p>

    <a href="{{ url()->previous() }}" 
       class="mt-6 inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
       Back
    </a>
</div>
@endsection
