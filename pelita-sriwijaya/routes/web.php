<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PpdbOnlineController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginPpdbController;
use App\Http\Controllers\RegisterAccountPPDBController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Form login
Route::get('/ppdb/login', [LoginPpdbController::class, 'showLoginForm'])->name('login');
Route::post('/ppdb/login', [LoginPpdbController::class, 'login'])->name('ppdb.login.submit');

// Form register akun
Route::get('/ppdb/register', [RegisterAccountPPDBController::class, 'index'])->name('ppdb.register');
Route::post('/ppdb/register', [RegisterAccountPPDBController::class, 'store'])->name('ppdb.register.submit');

// Formulir PPDB (hanya setelah login)
// Tambahkan di dalam middleware auth
Route::middleware('auth:ppdb')->group(function () {
    Route::get('/ppdb-online', [PpdbOnlineController::class, 'index'])->name('ppdb-online.index');
    Route::post('/ppdb-online', [PpdbOnlineController::class, 'store'])->name('ppdb-online.store');
    Route::post('/logout', [LoginPpdbController::class, 'logout'])->name('logout');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');