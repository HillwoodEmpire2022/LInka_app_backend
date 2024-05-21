<?php

use App\Http\Controllers\ChattingController;
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

Route::prefix("/chatting")->group(function() {

    // Text Messages endpoints
    Route::post("/message/send", [ChattingController::class, "createchatting"]);
    
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
