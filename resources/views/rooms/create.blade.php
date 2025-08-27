@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Room</h1>

    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Select Hotel</label>
            <select name="hotel_id" class="w-full border rounded p-2">
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Room Number</label>
            <input type="text" name="room_number" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Type</label>
            <input type="text" name="type" class="w-full border rounded p-2" placeholder="Single / Double / Suite">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Price (per night)</label>
            <input type="number" step="0.01" name="price" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('admin.rooms.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
