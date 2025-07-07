<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PpdbOnlineController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/ppdb-online', [PpdbOnlineController::class, 'index'])->name('ppdb-online.index');
Route::post('/ppdb-online', [PpdbOnlineController::class, 'store'])->name('ppdb-online.store');

Route::get('/about', [AboutController::class, 'index'])->name('about');