<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;

// ================== Public Routes ================== //
Route::get('/', [HotelController::class, 'index'])->name('home');

//===============login Route ==============//
Route::get('/login',[AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//===============Register Route ==============//
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Hotel listing & details
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');

// ================== Authenticated User Routes ================== //
Route::middleware(['auth'])->group(function () {
    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{roomId}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// ================== Admin Routes ================== //
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    // Hotels CRUD
    Route::get('/hotels', [HotelController::class, 'index'])->name('admin.hotels.index');
    Route::get('/hotels/create', [HotelController::class, 'create'])->name('admin.hotels.create');
    Route::post('/hotels', [HotelController::class, 'store'])->name('admin.hotels.store');
    Route::get('/hotels/{id}/edit', [HotelController::class, 'edit'])->name('admin.hotels.edit');
    Route::put('/hotels/{id}', [HotelController::class, 'update'])->name('admin.hotels.update');
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('admin.hotels.destroy');

    // Rooms CRUD
    Route::get('/rooms', [RoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');

    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
    
        Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');

    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});





Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
 

});
Route::middleware(['auth'])->group(function () {

    Route::get('/mybookings', [BookingController::class, 'myBookings'])->name('bookings.all');

});

Route::get('/hotels', [HotelController::class, 'index'])->name('admin.hotels.index');
Route::get('/rooms', [RoomController::class, 'index'])->name('admin.rooms.index');

    Route::get('/hotels/create', [HotelController::class, 'create'])->name('admin.hotels.create');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
        Route::post('/rooms', [RoomController::class, 'store'])->name('admin.rooms.store');


        

        
