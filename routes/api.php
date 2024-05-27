<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\TherapyController;




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

    // Profile Routes end endpoint
Route::apiResource('/profile',ProfileController::class);    
Route::post('/profile/{profile}/reaction',[ProfileController::class,'profileReaction']);
Route::get('/profile/{profile}/reactions',[ProfileController::class,'getReactions']);
   
    // Tips Routes end points
Route::get('/tips',[TipController::class,'index']);    
Route::post('/tip/create',[TipController::class,'store']);
Route::put('/tip/{tip}/update',[TipController::class,'update']);
Route::delete('/tip/{tip}/delete',[TipController::class,'destroy']);
Route::get('/tip/{tip}/get',[TipController::class,'show']);

});

Route::post('/login', [AuthController::class, 'Login']);
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/profile/forgot-password',[AuthController::class,'forgot']);
Route::post('/profile/reset-password',[AuthController::class,'ResetPassword']);

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);


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



