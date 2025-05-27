<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PaslonController as AdminPaslonController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::view('/token', 'admin.token')->name('token');
    Route::view('/hasil', 'admin.hasil')->name('hasil');
    Route::resource('paslon', AdminPaslonController::class);
});
