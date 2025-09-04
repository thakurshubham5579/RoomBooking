@extends('layouts.owner')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Room in {{ $hotel->name }}</h1>

    {{-- ✅ Correct route for update --}}
    <form method="POST" action="{{ route('owner.hotels.rooms.update', [$hotel->id, $room->id]) }}">
        @csrf
        @method('PUT')

        {{-- Room Number --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Room Number</label>
            <input type="text" name="room_number"
                   value="{{ old('room_number', $room->room_number) }}"
                   class="w-full border rounded px-3 py-2">
            @error('room_number')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Room Type --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Type</label>
            <select name="type" class="w-full border rounded px-3 py-2">
                @foreach(['Single','Double','Suite','Deluxe','Family'] as $type)
                    <option value="{{ $type }}" {{ old('type', $room->type) === $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Price --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Price</label>
            <input type="number" step="0.01" name="price"
                   value="{{ old('price', $room->price) }}"
                   class="w-full border rounded px-3 py-2">
            @error('price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="available" {{ old('status', $room->status) === 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ old('status', $room->status) === 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="maintenance" {{ old('status', $room->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description"
                      class="w-full border rounded px-3 py-2">{{ old('description', $room->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-4">
    {{-- Submit --}}
    <button type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Update Room
    </button>

    {{-- Back Link --}}
    <a href="{{ route('owner.hotels.rooms.index', $hotel->id) }}"
       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
        Back
    </a>
</div>

    </form>
</div>
@endsection
