<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PpdbOnlineController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DataOrangTuaController;
use App\Http\Controllers\LoginPpdbController;
use App\Http\Controllers\PpdbForgotPasswordController;
use App\Http\Controllers\ppdbResetPasswordController;
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
Route::get('/about', [AboutController::class, 'index'])->name('about');


Route::prefix('ppdb')->group(function () {
    // Redirect ke halaman welcome PPDB
    Route::get('/', function () {
        return redirect()->route('page.ppdb.welcomePpdb');
    })->name('ppdb');

    // Menampilkan halaman welcome PPDB
    Route::get('/welcome', function () {
        return view('page.ppdb.welcomePpdb');
    })->name('page.ppdb.welcomePpdb');

    // Rute Lupa Password
    Route::get('/forgot-password', [PpdbForgotPasswordController::class, 'showLinkRequestForm'])
        ->middleware('guest:ppdb')
        ->name('ppdb.password.request');

    Route::post('/forgot-password', [PpdbForgotPasswordController::class, 'sendResetLinkEmail'])
        ->middleware('guest:ppdb')
        ->name('ppdb.password.email');

    Route::get('/reset-password/{token}', [ppdbResetPasswordController::class, 'showResetForm'])
        ->middleware('guest:ppdb')
        ->name('ppdb.password.reset');

    Route::post('/reset-password', [ppdbResetPasswordController::class, 'reset'])
        ->middleware('guest:ppdb')
        ->name('ppdb.password.update');

    Route::get('/login', [LoginPpdbController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginPpdbController::class, 'login'])->name('ppdb.login.submit');

    Route::get('/register', [RegisterAccountPPDBController::class, 'index'])->name('ppdb.register');
    Route::post('/register', [RegisterAccountPPDBController::class, 'store'])->name('ppdb.register.submit');

    Route::middleware('auth:ppdb')->group(function () {
        Route::get('/ppdb-online', [PpdbOnlineController::class, 'index'])->name('ppdb-online.index');
        Route::post('/ppdb-online', [PpdbOnlineController::class, 'store'])->name('ppdb-online.store');
        Route::post('/logout', [LoginPpdbController::class, 'logout'])->name('logout');
        Route::get('/pendaftaran', [PpdbOnlineController::class, 'showPendaftaranPage'])->name('ppdb-online.pendaftaran');
        Route::get('/formulir/{jenjang}', [PpdbOnlineController::class, 'showFormulir'])->name('ppdb-online.formulir');
        // isi data orang tua
        Route::get('/data-orangtua/isi', [DataOrangTuaController::class, 'create'])->name('ppdb.data-orangtua.create');
        Route::post('/data-orangtua', [DataOrangTuaController::class, 'store'])->name('ppdb.data-orangtua.store');
        Route::get('/data-orangtua/edit', [DataOrangTuaController::class, 'edit'])->name('ppdb.data-orangtua.edit');
        // update data orang tua
        Route::post('/data-orangtua/update', [DataOrangTuaController::class, 'update'])->name('ppdb.data-orangtua.update');
    });
});
