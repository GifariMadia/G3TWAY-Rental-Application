<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RentalController;

// Halaman Utama
Route::get('/', [LandingController::class, 'index'])->name('home');

// =======================
// Halaman Auth (Form View)
// =======================
Route::view('/signin', 'signin')->name('signin');
Route::get('/profile', [UserController::class, 'show'])->name('profile.show');

// =======================
// Aksi Auth (POST)
// =======================
Route::post('/signin', [UserController::class, 'signin'])->name('signin.process');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// =======================
// Rute Profil Pengguna
// =======================
Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
Route::delete('/profile/{id}', [UserController::class, 'destroy'])->name('profile.destroy');

// =======================
// Rute Mobil
// =======================

Route::get('/cars/{car_id}', [CarController::class, 'show'])->name('cars.detail');


// =======================
// Rute Sewa Mobil
// =======================
Route::view('/rentals/create', 'rentals.create')->name('rentals.create');
Route::post('/rentals/create', [RentalController::class, 'store'])->name('cars.store');
Route::get('/cars', [CarController::class, 'showAllCars'])->name('cars.index');

// =======================
// Rute Sidebar Menu
// =======================
Route::view('/reviews', 'reviews.index')->name('reviews.index');
Route::view('/reviews/create', 'reviews.create')->name('reviews.create');
Route::post('/review/create', [CarController::class, 'update'])->name('reviews.store');

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/{car_id}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
Route::put('/rentals/{car_id}', [RentalController::class, 'update'])->name('rentals.update');
Route::delete('/rentals/{car_id}', [RentalController::class, 'destroy'])->name('rentals.destroy');

// =======================
// Tes Koneksi Database
// =======================
Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return "Database Terhubung!";
    } catch (\Exception $e) {
        return "Database Tidak Terhubung: " . $e->getMessage();
    }
});
