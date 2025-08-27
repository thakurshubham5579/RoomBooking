@extends('layouts.app')
@section('content')
    <h2 class="text-2xl font-bold mb-4">Login</h2>

    {{-- Show error if email not registered or login fails --}}
    @if($errors->has('email'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block">Email</label>
            <input type="email" name="email" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block">Password</label>
            <input type="password" name="password" required class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>

    <p class="mt-4">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 underline">Register</a></p>
@endsection