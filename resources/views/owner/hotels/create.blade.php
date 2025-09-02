@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Add New Hotel</h1>

    <form action="{{ route('owner.hotels.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block">Hotel Name</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Location</label>
            <input type="text" name="location" class="border p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Description</label>
            <textarea name="description" class="border p-2 w-full"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Save Hotel</button>
    </form>
</div>
@endsection
