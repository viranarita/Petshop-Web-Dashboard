<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;
use App\Models\Product;

// PENTING: Pastiin baris ini ada biar filenya ketemu
use App\Livewire\Booking\Create as BookingCreate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. BERANDA (Landing Page)
Route::get('/', function () {
    return view('welcome', [
        'services' => Service::all(),
        'products' => Product::all(),
    ]);
})->name('home');

// 2. LAYANAN (Halaman Stepper)
// Kalau ini masih error, berarti folder App\Livewire\Booking\Create.php lo salah tempat
Route::get('/booking', BookingCreate::class)->name('booking');

// 3. LOGIN (Biar tombol Masuk gak error)
Route::get('/login', function() {
    return "Halaman Login Belum Dibuat";
})->name('login');