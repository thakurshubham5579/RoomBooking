@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Hotels</h1>
<div class="grid grid-cols-3 gap-4">
    @foreach($hotels as $hotel)
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-semibold">{{ $hotel->name }}</h2>
            <p>{{ $hotel->location }}</p>
            <a href="/hotels/{{ $hotel->id }}" class="text-blue-600">View</a>
        </div>
    @endforeach
</div>
@endsection
