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


use App\Http\Controllers\Owner\OwnerHotelController;

Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function () {
    Route::resource('hotels', OwnerHotelController::class);
});




use App\Http\Controllers\Owner\OwnerHomeController;

Route::prefix('owner')->middleware(['auth'])->group(function () {
    Route::get('home', [OwnerHomeController::class, 'index'])->name('owner.home');
});

use App\Http\Controllers\Owner\OwnerBookingController;

Route::prefix('owner')->name('owner.')->middleware(['auth'])->group(function () {
    Route::resource('bookings', OwnerBookingController::class);
});


Route::prefix('owner')->name('owner.')->middleware(['auth'])->group(function () {
    Route::resource('hotels', OwnerHotelController::class);
   
    Route::resource('bookings', OwnerBookingController::class)->only(['index', 'show']);
});



use App\Http\Controllers\Owner\OwnerRoomController;



Route::prefix('owner')->name('owner.')->middleware(['auth'])->group(function () {
    Route::get('hotels/{hotel}/rooms', [OwnerRoomController::class, 'index'])->name('rooms.index');
    Route::get('hotels/{hotel}/rooms/create', [OwnerRoomController::class, 'create'])->name('rooms.create');
    Route::post('hotels/rooms', [OwnerRoomController::class, 'store'])->name('rooms.store');

     Route::get('hotels/{hotel}/rooms/{room}/edit', [OwnerRoomController::class, 'edit'])->name('rooms.edit');
    Route::put('hotels/{hotel}/rooms/{room}', [OwnerRoomController::class, 'update'])->name('rooms.update');
    Route::delete('hotels/{hotel}/rooms/{room}', [OwnerRoomController::class, 'destroy'])->name('rooms.destroy');

    
});

Route::post('hotels/{hotel}/rooms', [OwnerRoomController::class, 'store'])->name('rooms.store');
