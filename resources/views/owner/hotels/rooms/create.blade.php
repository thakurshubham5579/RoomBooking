@extends('layouts.owner')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Add New Room</h1>

    <form method="POST" action="{{ route('owner.rooms.store') }}">
        @csrf

        {{-- Select Hotel --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Select Hotel</label>
            <select name="hotel_id" class="w-full border rounded px-3 py-2">
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
            @error('hotel_id') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Room Number --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Room Number</label>
            <input type="text" name="room_number" value="{{ old('room_number') }}"
                   class="w-full border rounded px-3 py-2">
            @error('room_number') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Room Type --}}
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

        {{-- Price --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border rounded px-3 py-2">
            @error('price') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>Booked</option>
            </select>
            @error('status') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            @error('description') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Save Room
        </button>
    </form>
</div>
@endsection
