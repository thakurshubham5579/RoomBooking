<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Public\HotelController as PublicHotelController;
use App\Http\Controllers\Public\BookingController as PublicBookingController;
use App\Http\Controllers\Public\UserController;

use App\Http\Middleware\IsAdmin;

// ================== Public Routes ================== //

// Homepage
Route::get('/', [UserController::class, 'home'])->name('home');

// Hotels (public)
Route::prefix('/')->name('public.')->group(function () {
    Route::resource('hotels', PublicHotelController::class)->names('hotels');
});


//=============== Login Routes ==============//
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//=============== Register Routes ==============//
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ================== Public Booking Routes ================== //
Route::prefix('public')->middleware('auth')->group(function () { 
    Route::get('/my-bookings', [PublicBookingController::class, 'myBookings'])->name('public.bookings.my_bookings'); 
    Route::post('/book-room/{room}', [PublicBookingController::class, 'bookRoom'])->name('public.bookings.book_room'); 
    Route::delete('/my-bookings/{id}', [PublicBookingController::class, 'cancel'])->name('public.bookings.cancel'); });
// ================== Admin Routes ================== //
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    // ✅ Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // ✅ Hotels CRUD
    Route::resource('hotels', AdminHotelController::class);

    // ✅ Rooms CRUD
    Route::resource('rooms', AdminRoomController::class);

    // ✅ Bookings (index, show, destroy only)
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy']);
});

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {

    Route::delete('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])->name('admin.bookings.cancel');
});
