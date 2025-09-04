@extends('layouts.owner')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Hotels</h1>
        
        <a href="{{ route('owner.hotels.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
           + Add Hotel
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($hotels->isEmpty())
        <p class="text-gray-600">No hotels available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($hotels as $hotel)
            <div class="border rounded-lg shadow-md p-4 bg-white">
                <h2 class="text-xl font-semibold">{{ $hotel->name }}</h2>
                <p class="text-gray-600">{{ $hotel->description }}</p>
                <p class="text-sm text-gray-500">
                    Location: {{ $hotel->location ?? 'Not specified' }}
                </p>

                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('owner.hotels.show', $hotel->id) }}" 
                       class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                       View
                    </a>
                    <a href="{{ route('owner.hotels.edit', $hotel->id) }}" 
                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                       Edit
                    </a>
                    <form action="{{ route('owner.hotels.destroy', $hotel->id) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this hotel?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
