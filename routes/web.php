<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Public\HotelController as PublicHotelController;
use App\Http\Middleware\IsAdmin;

// ================== Public Routes ================== //
use App\Http\Controllers\Public\UserController;




// Homepage
Route::get('/', [UserController::class, 'home'])->name('home');

// Hotels
Route::prefix('/')->name('public.')->group(function () {
    Route::resource('hotels', PublicHotelController::class)->names('hotels');
});

// Rooms (user view only)
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');



//===============login Route ==============//
Route::get('/login',[AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//===============Register Route ==============//
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);



// ================== Admin Routes ================== //
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {


    // Rooms CRUD
    Route::get('/rooms', [RoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
    
    Route::post('/rooms', [RoomController::class, 'show'])->name('admin.rooms.show');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
    
        Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');

    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});









// Authenticated user routes
//Route::middleware(['auth', 'role:user'])->group(function () {
   // Route::get('/', [UserController::class, 'index'])->name('home');
//});

Route::post('/rooms', [RoomController::class, 'store'])->name('admin.rooms.store');


        


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('hotels', HotelController::class);
});











