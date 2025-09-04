@extends('layouts.owner')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Rooms</h1>
        
        {{-- ✅ Pass hotel ID for nested route --}}
        <a href="{{ route('owner.hotels.rooms.create', $hotel->id) }}" 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
           + Add Room
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($rooms->isEmpty())
        <p class="text-gray-600">No rooms available for this hotel.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($rooms as $room)
            <div class="border rounded-lg shadow-md p-4 bg-white">
                <h2 class="text-xl font-semibold">Room {{ $room->room_number }}</h2>
                <p class="text-gray-600">{{ $room->type }}</p>
                <p class="text-gray-800 font-bold">₹{{ $room->price }} / night</p>
                <p class="text-sm text-gray-500">Status: {{ ucfirst($room->status) }}</p>

                {{-- ✅ No need to show hotel info here because it's already scoped --}}
                {{-- If you want to still show it, keep this block --}}
                @if($room->hotel)
                    <div class="mt-3 p-2 bg-gray-50 rounded">
                        <p class="text-sm font-semibold text-gray-700">
                            Hotel: {{ $room->hotel->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Location: {{ $room->hotel->location }}
                        </p>
                    </div>
                @endif

                

                <div class="mt-4 flex space-x-2">

                {{-- ✅ View Details --}}
                <a href="{{ route('owner.hotels.rooms.show', [$hotel->id, $room->id]) }}"
                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                   View
                </a>

                    {{-- ✅ Edit requires both hotel + room --}}
                    <a href="{{ route('owner.hotels.rooms.edit', [$hotel->id, $room->id]) }}" 
                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                       Edit
                    </a>

                    <form action="{{ route('owner.hotels.rooms.destroy', [$hotel->id, $room->id]) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this room?');">
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
