<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\MachingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConversationController;
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

    // Text Messages endpoints
    Route::post("/message/send", [ChattingController::class, "createChatting"]);
    
    Route::get("/message/list", [ChattingController::class, "chattingList"]);
    
    Route::get("/message/one", [ChattingController::class, "oneChattMessage"]); 

    Route::delete("/message/delete", [ChattingController::class, "deletingChat"]);

    Route::patch('/message/update', [ChattingController::class, "updatingChat"]);

    // Audio Messages endpoints
    Route::post("/audio/send", [ChattingController::class, "AudioChatting"]);

    Route::delete("/audio/delete", [ChattingController::class, "deletingAudioChatt"]);

    Route::delete("/audio/one", [ChattingController::class, "findOneAudiChat"]);

   // Picture Messages endpoints
    Route::post("/picture/send", [ChattingController::class, "pictureChatting"]);

    Route::delete("/picture/delete", [ChattingController::class, "deletingPictureChat"]);

    Route::get("/picture/one", [ChattingController::class, "findOnePicture"]);
    
});

Route::prefix("/convo")->group(function(){
    
    Route::get("/find", [ConversationController::class, "findOneConvo"]);

    Route::get('/all', [ConversationController::class, "findAllConvo"]);

    Route::delete('/delete', [ConversationController::class, "deleteConvo"]);
    
});


Route::prefix("/match")->group(function() {

    Route::post("/request-match/{matchFrom}/{matchTo}", [MachingController::class, "requestMatching"]); // working well. but it is not protected

    Route::put("/update-match/{matchFrom}/{matchTo}", [MachingController::class, "updateMatching"]); // working well. but it is not protected

    Route::get("/list-match/{linkaUser}", [MachingController::class, "listMatching"]); // working well. but it is not protected

    Route::delete("decline-match/{matchFrom}/{matchTo}", [MachingController::class, "declineMatching"]); // working well. but it is not protected
});
