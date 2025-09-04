@extends('layouts.owner')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Hotel</h1>

    <form action="{{ route('owner.hotels.update', $hotel->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ $hotel->name }}" class="border p-2 w-full" required>
        </div>
        <div>
            <label>Location</label>
            <input type="text" name="location" value="{{ $hotel->location }}" class="border p-2 w-full" required>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
