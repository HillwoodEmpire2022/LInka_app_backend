<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\MachingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


});

Route::post('/login', [AuthenticationController::class, 'loginUser']);
Route::post('/register', [AuthenticationController::class, 'registerUser']);

Route::prefix("/profile")->group(function() {
    Route::post("/create/{userID}", [ProfileController::class, "createProfile"])->whereNumber("userID");
    Route::put("/update/{userID}", [ProfileController::class, "updateProfile"])->whereNumber("profileID");
    Route::post("/disable/{profileID}", [ProfileController::class, "disableProfile"])->whereNumber("profileID");
    Route::get("/list", [ProfileController::class, "listProfile"]);
    Route::get("/list/{userID}", [ProfileController::class, "profileDetails"]);
});


Route::prefix("/chatting")->group(function() {

    Route::post("/linka/{senderID}/{receiverID}", [ChattingController::class, "createChatting"]);

    Route::get("/linka/chat-list/{userID}", [ChattingController::class, "chattingList"]);

    Route::get("/linka/chat-messsage/{senderID}/{receiverID}", [ChattingController::class, "chattingMessages"]);
});

Route::prefix("/match")->group(function() {
    Route::post("/request-match/{matchFrom}/{matchTo}", [MachingController::class, "requestMatching"]);

    Route::put("/update-match/{matchFrom}/{matchTo}", [MachingController::class, "updateMatching"]);

    Route::get("/list-match/{linkaUser}", [MachingController::class, "listMatching"]);

    Route::delete("decline-match/{matchFrom}/{matchTo}", [MachingController::class, "declineMatching"]);
});
