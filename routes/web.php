<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/booking', \App\Livewire\Booking\Create::class)->name('booking');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');
Route::get('/customers', \App\Livewire\Customer\Index::class)->name('customers')->middleware('auth');
Route::get('/calendar', \App\Livewire\Calendar::class)->name('calendar')->middleware('auth');
Route::get('/pos', \App\Livewire\Pos\Terminal::class)->name('pos')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');
