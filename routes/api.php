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

Route::post('/login', [AuthenticationController::class, 'loginUser']); // working well

Route::post('/register', [AuthenticationController::class, 'registerUser']); // working well

Route::prefix("/profile")->group(function() { 

    Route::post("/create/{userID}", [ProfileController::class, "createProfile"])->whereNumber("userID"); // working well. b ut it is not protected

    Route::put("/update/{userID}", [ProfileController::class, "updateProfile"])->whereNumber("profileID"); // working well. b ut it is not protected

    Route::post("/disable/{profileID}", [ProfileController::class, "disableProfile"])->whereNumber("profileID");

    Route::get("/list", [ProfileController::class, "listProfile"]); // working well. b ut it is not protected

    Route::get("/list/{userID}", [ProfileController::class, "profileDetails"]); // working well. b ut it is not protected
});

Route::prefix("/chatting")->group(function() {

    Route::post("/message/send", [ChattingController::class, "createChatting"]); 

    Route::get("/message/list", [ChattingController::class, "chattingList"]); 

    Route::delete("/message/delete", [ChattingController::class, "deletingChat"]); 
    
    Route::patch('/message/update', [ChattingController::class, "updatingChat"]);
});


Route::prefix("/match")->group(function() {

    Route::post("/request-match/{matchFrom}/{matchTo}", [MachingController::class, "requestMatching"]); // working well. but it is not protected

    Route::put("/update-match/{matchFrom}/{matchTo}", [MachingController::class, "updateMatching"]); // working well. but it is not protected

    Route::get("/list-match/{linkaUser}", [MachingController::class, "listMatching"]); // working well. but it is not protected

    Route::delete("decline-match/{matchFrom}/{matchTo}", [MachingController::class, "declineMatching"]); // working well. but it is not protected
});
