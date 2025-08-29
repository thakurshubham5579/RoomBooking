@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Browse Hotels</h1>

    @if($hotels->isEmpty())
        <p class="text-gray-600">No hotels found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($hotels as $hotel)
                <div class="border rounded-lg shadow-md p-4 bg-white">
                    <h2 class="text-xl font-semibold">{{ $hotel->name }}</h2>
                    <p class="text-gray-600"><strong>Location:</strong> {{ $hotel->location }}</p>
                    <p class="text-gray-600"><strong>Description:</strong> {{ Str::limit($hotel->description, 80) }}</p>

                    <p class="text-gray-800 font-bold">
                        Price Range: ₹{{ $hotel->rooms->min('price') ?? 'N/A' }} - ₹{{ $hotel->rooms->max('price') ?? 'N/A' }}
                    </p>

                    <a href="{{ route('public.hotels.show', $hotel->id) }}"
                       class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                       View Details
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $hotels->links() }}
        </div>
    @endif
</div>
@endsection

