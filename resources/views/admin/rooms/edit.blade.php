@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Room</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Room Number</label>
            <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}" 
                class="w-full border rounded p-2" required>
        </div>

         <div class="mb-4">
            <label class="block font-semibold mb-2">Type</label>
            <select name="type" class="w-full border rounded px-3 py-2">
                <option value="Single" {{ old('type') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Double" {{ old('type') == 'Double' ? 'selected' : '' }}>Double</option>
                <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                <option value="Deluxe" {{ old('type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="Family" {{ old('type') == 'Family' ? 'selected' : '' }}>Family</option>
            </select>
            @error('type') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Price (₹)</label>
            <input type="number" name="price" value="{{ old('price', $room->price) }}" 
                class="w-full border rounded p-2" required>
        </div>

        {{-- ✅ Hotel ID --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Hotel</label>
            <select name="hotel_id" class="w-full border rounded p-2" required>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" 
                        {{ old('hotel_id', $room->hotel_id) == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="w-full border rounded p-2" required>
                <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ old('status', $room->status) == 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.rooms.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update Room
            </button>
        </div>
    </form>
</div>
@endsection
