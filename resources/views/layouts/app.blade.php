<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <a href="{{ route('public.hotels.index') }}" class="font-bold">Hotel Booking</a>
        <div>
            @auth
                <a href="{{ route('owner.home') }}" class="mr-4">ownerhome</a>
                <a href="{{ route('public.bookings.my_bookings') }}" class="mr-4">My Bookings</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>
