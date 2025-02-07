<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
use App\Http\Controllers\Auth\LoginController;

// Show login form
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Submit login form
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// Logout route
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
