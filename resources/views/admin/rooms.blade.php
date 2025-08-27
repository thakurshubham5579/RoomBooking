@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Manage Rooms</h1>

    <a href="{{ route('admin.rooms.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 mb-4 inline-block">
        + Add Room
    </a>

    <div class="bg-white rounded-xl shadow-md p-4">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">Hotel</th>
                    <th class="p-3">Room Number</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Capacity</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr class="border-b">
                    <td class="p-3">{{ $room->id }}</td>
                    <td class="p-3">{{ $room->hotel->name }}</td>
                    <td class="p-3">{{ $room->room_number }}</td>
                    <td class="p-3">{{ ucfirst($room->type) }}</td>
                    <td class="p-3">${{ number_format($room->price, 2) }}</td>
                    <td class="p-3">{{ $room->capacity }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">Edit</a>
                        
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this room?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $rooms->links() }} {{-- Pagination --}}
        </div>
    </div>
</div>
@endsection
