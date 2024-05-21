<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MachingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
   
});
Route::post('/profile/{profile}/reaction',[ProfileController::class,'profileReaction']);
Route::apiResource('/profile',ProfileController::class);
Route::get('/profile/{profile}/reactions',[ProfileController::class,'getReactions']);

Route::post('/login', [AuthController::class, 'Login']);
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/profile/forgot-password',[AuthController::class,'forgot']);
Route::post('/profile/reset-password',[AuthController::class,'ResetPassword']);

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);








// Route::prefix("/chatting")->group(function() {

//     Route::post("/linka/{senderID}/{receiverID}", [ChattingController::class, "createChatting"]);

//     Route::get("/linka/chat-list/{userID}", [ChattingController::class, "chattingList"]);

//     Route::get("/linka/chat-messsage/{senderID}/{receiverID}", [ChattingController::class, "chattingMessages"]);
// });

// Route::prefix("/match")->group(function() {
//     Route::post("/request-match/{matchFrom}/{matchTo}", [MachingController::class, "requestMatching"]);

//     Route::put("/update-match/{matchFrom}/{matchTo}", [MachingController::class, "updateMatching"]);

//     Route::get("/list-match/{linkaUser}", [MachingController::class, "listMatching"]);

//     Route::delete("decline-match/{matchFrom}/{matchTo}", [MachingController::class, "declineMatching"]);
// });
