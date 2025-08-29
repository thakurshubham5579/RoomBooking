<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <nav class="bg-gray-800 text-white p-4 flex justify-between">
        <span class="font-bold">Admin Dashboard</span>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="mr-4">Dashboard</a>
            <a href="{{ route('admin.hotels.index') }}" class="mr-4">Hotels</a>
            <a href="{{ route('admin.bookings.index') }}" class="mr-4">Bookings</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>
