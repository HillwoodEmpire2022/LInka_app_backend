<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/{provider}', [AuthenticationController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [AuthenticationController::class, 'handleProviderCallback']);
Route::get('/login',[AuthController::class,'login'])->name('login');

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);


Route::get('/forgot-password', function () {
    return view('forgot-password');
})->middleware('guest')->name('password.reset');