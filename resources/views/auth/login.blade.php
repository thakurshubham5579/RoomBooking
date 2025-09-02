@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">

    <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

    {{-- Show login error (wrong email or password) --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
                required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block font-medium">Password</label>
            <input type="password" name="password" id="password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
                required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Login Button --}}
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Login
            </button>
        </div>
    </form>

    <p class="mt-4 text-center text-gray-600">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
    </p>
</div>
@endsection
