<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\TokenAuthController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Admin\PaslonController as AdminPaslonController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::view('/hasil', 'admin.hasil')->name('hasil');
    Route::resource('paslon', AdminPaslonController::class);
    Route::resource('token', TokenController::class);

});
// Route untuk token auth
Route::controller(TokenAuthController::class)->group(function () {
    Route::get('/token-login', 'showTokenForm')->name('token.login');
    Route::post('/token-login', 'processTokenLogin');
     Route::post('/token-logout', 'logout')->name('token.logout');
});

// Route voting dengan pengecekan token
Route::controller(VotingController::class)->group(function () {
    Route::get('/voting', 'checkToken')->name('voting');
    Route::post('/voting', 'store')->name('voting.submit');
});
