@extends('layouts.app')
@section('content')

    <h2 class="text-2xl font-bold mb-4">Register</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block">Name</label>
            <input type="text" name="name" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block">Email</label>
            <input type="email" name="email" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block">Password</label>
            <input type="password" name="password" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Register
        </button>
    </form>

    <p class="mt-4">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 underline">Login</a></p>
@endsection