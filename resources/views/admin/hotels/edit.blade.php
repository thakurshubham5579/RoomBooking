@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Hotel</h1>

    <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium">Hotel Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $hotel->name) }}"
                class="w-full border rounded p-2" required>
            @error('name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block font-medium">Description</label>
            <textarea id="description" name="description" rows="4"
                class="w-full border rounded p-2">{{ old('description', $hotel->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="location" class="block font-medium">Location</label>
            <input type="text" id="location" name="location" value="{{ old('location', $hotel->location) }}"
                class="w-full border rounded p-2">
            @error('location')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update Hotel
        </button>
    </form>
</div>
@endsection
