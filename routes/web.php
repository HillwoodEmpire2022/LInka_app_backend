<?php
use App\Http\Controllers\GoogleLoginController;
use Illuminate\Support\Facades\Route;


Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);