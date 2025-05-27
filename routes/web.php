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
Route::view('/signin', 'signin')->name('signin'); // Form signin/login
Route::get('/profile', [UserController::class, 'show'])->name('profile.show'); // Menampilkan profil

// =======================
// Aksi Auth (POST)
// =======================
Route::post('/signin', [UserController::class, 'signin'])->name('signin.process'); // Aksi signin/login
Route::post('/register', [UserController::class, 'store'])->name('register.store'); // Aksi registrasi

// =======================
// Rute Profil Pengguna
// =======================
Route::get('/profile', [UserController::class, 'show'])->name('profile.show'); // Menampilkan profil
Route::post('/profile', [UserController::class, 'update'])->name('profile.update'); // Update profil
Route::delete('/profile/{id}', [UserController::class, 'destroy'])->name('profile.destroy');

// =======================
// Rute Mobil
// =======================

// Rute untuk melihat detail mobil
Route::get('/cars/{car_id}', [CarController::class, 'show'])->name('cars.detail');


// =======================
// Rute Sewa Mobil
// =======================
Route::view('/rentals/create', 'rentals.create')->name('rentals.create');
Route::post('/rentals/create', [RentalController::class, 'store'])->name('cars.store'); // Menambahkan data mobil baru
Route::get('/cars', [CarController::class, 'showAllCars'])->name('cars.index'); // Menampilkan daftar mobil dengan relasi

// =======================
// Rute Sidebar Menu
// =======================
Route::view('/reviews', 'reviews.index')->name('reviews.index');
Route::view('/reviews/create', 'reviews.create')->name('reviews.create');
Route::post('/review/create', [CarController::class, 'update'])->name('reviews.store'); // Update review mobil

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/{car_id}/edit', [RentalController::class, 'edit'])->name('rentals.edit');  // Tampilkan form edit rental
Route::put('/rentals/{car_id}', [RentalController::class, 'update'])->name('rentals.update');
Route::delete('/rentals/{car_id}', [RentalController::class, 'destroy'])->name('rentals.destroy'); // Hapus rental
 // Proses update rental

// =======================
// Tes Koneksi Database (Opsional)
// =======================
Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return "Database Terhubung!";
    } catch (\Exception $e) {
        return "Database Tidak Terhubung: " . $e->getMessage();
    }
});
