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
Route::get('/kontak', function () {
    return view('page.contact');
})->name('contact');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::prefix('ppdb')->group(function () {
    // Redirect ke halaman welcome PPDB
    Route::get('/', function () {
        return redirect()->route('page.ppdb.welcomePpdb');
    })->name('ppdb');

    // Menampilkan halaman welcome PPDB
    Route::get('/welcome', function () {
        return view('page.ppdb.welcomePpdb');
    })->name('page.ppdb.welcomePpdb');

    Route::get('/login', [LoginPpdbController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginPpdbController::class, 'login'])->name('ppdb.login.submit');

    Route::get('/register', [RegisterAccountPPDBController::class, 'index'])->name('ppdb.register');
    Route::post('/register', [RegisterAccountPPDBController::class, 'store'])->name('ppdb.register.submit');

    Route::middleware('auth:ppdb')->group(function () {
        Route::get('/ppdb-online', [PpdbOnlineController::class, 'index'])->name('ppdb-online.index');
        Route::post('/ppdb-online', [PpdbOnlineController::class, 'store'])->name('ppdb-online.store');
        Route::post('/logout', [LoginPpdbController::class, 'logout'])->name('logout');
    });
});

Route::get('/about', [AboutController::class, 'index'])->name('about');
