<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\TherapyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TherapyTypeController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\AppointmentVerificationController;
use App\Http\Controllers\UserLocationController;



/*
The logout route will be protected with the auth and verify.api middleware, 
because only logged in users can log out, and only verified users can have 
access to other endpoints. The verify email route will be protected with the 
auth middleware. The other routes don’t need users to be authenticated or verified, 
so don't need to be protected by any middleware.
*/


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/email/verify',[AuthController::class,'verifyEmail']);
    
    Route::middleware('verify.api')->group(function () {
        Route::post('/logout',[AuthController::class, 'logout']);
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/resend/email/token', [AuthController::class, 'resendPin']);
Route::post('/forgot/password',[AuthController::class,'forgotPassword']);
Route::post('/verify/pin', [AuthController::class, 'verifyPin']);
Route::post('/reset/password',[AuthController::class,'resetPassword']);





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


// Route::prefix("/chatting")->group(function() {

    // Text Messages endpoints
    Route::post("/message/send", [ChattingController::class, "createchatting"])->middleware('verify.api');
    
    Route::get("/message/list", [ChattingController::class, "chattingList"])->middleware('verify.api');
    
    Route::get("/message/one", [ChattingController::class, "oneChattMessage"])->middleware('verify.api'); 

    Route::delete("/message/delete", [ChattingController::class, "deletingChat"])->middleware('verify.api');

    Route::patch('/message/update', [ChattingController::class, "updatingChat"])->middleware('verify.api');

    // Audio Messages endpoints
    Route::post("/audio/send", [ChattingController::class, "AudioChatting"])->middleware('verify.api');

    Route::delete("/audio/delete", [ChattingController::class, "deletingAudioChatt"])->middleware('verify.api');

    Route::delete("/audio/one", [ChattingController::class, "findOneAudiChat"])->middleware('verify.api');

   // Picture Messages endpoints
    Route::post("/picture/send", [ChattingController::class, "pictureChatting"])->middleware('verify.api');

    Route::delete("/picture/delete", [ChattingController::class, "deletingPictureChat"])->middleware('verify.api');

    Route::get("/picture/one", [ChattingController::class, "findOnePicture"])->middleware('verify.api');
    
// });

Route::prefix("/convo")->group(function(){
    
    Route::get("/find", [ConversationController::class, "findOneConvo"])->middleware('verify.api');

    Route::get('/all', [ConversationController::class, "findAllConvo"])->middleware('verify.api');

    Route::delete('/delete', [ConversationController::class, "deleteConvo"])->middleware('verify.api');
    
});

// Route::prefix("/therapy")->group(function(){

    Route::get("/category/all", [TherapyController::class, "getTherapyCategories"])->middleware('verify.api');

    Route::post("/category/create", [TherapyController::class, "createTherapyCategory"])->middleware('verify.api');

    Route::get("/category/find", [TherapyController::class, "getOneTherapy"])->middleware('verify.api');

    Route::patch("/category/update", [TherapyController::class, "updateTherapy"])->middleware('verify.api');

    Route::delete("/category/delete", [TherapyController::class, "deleteTherapy"])->middleware('verify.api');


    Route::post("/appointment/create", [AppointmentController::class, "createAppointment"])->middleware('verify.api');

    Route::get("/appointment/all", [AppointmentController::class, "getAllAppointment"])->middleware('verify.api');

    Route::get("/appointment/find", [AppointmentController::class, "getOneAppointment"])->middleware('verify.api');

    Route::patch("/appointment/update", [AppointmentController::class, "updateAppointment"])->middleware('verify.api');

    Route::delete("/appointment/delete", [AppointmentController::class, "deleteAppointment"])->middleware('verify.api');


    Route::post("/type/create", [TherapyTypeController::class, "createTherapyType"])->middleware('verify.api');

    Route::get("/type/all", [TherapyTypeController::class, "allTherapyType"])->middleware('verify.api');

    Route::get("/type/find", [TherapyTypeController::class, "findTherapyType"])->middleware('verify.api');

    Route::patch("/type/update", [TherapyTypeController::class, "updateTherapyType"])->middleware('verify.api');

    Route::delete("/type/delete", [TherapyTypeController::class, "deleteTherapyType"])->middleware('verify.api');


    Route::post("/therapist/create", [TherapistController::class, "createTherapist"])->middleware('verify.api');

    Route::get("/therapist/all", [TherapistController::class, "allTherapist"])->middleware('verify.api');

    Route::get("/therapist/one", [TherapistController::class, "findTherapist"])->middleware('verify.api');

    Route::patch("/therapist/update", [TherapistController::class, "updateTherapist"])->middleware('verify.api');

    Route::delete("/therapist/delete", [TherapistController::class, "deleteTherapist"])->middleware('verify.api');
    

    Route::post("/verification/create", [AppointmentVerificationController::class, "createVerification"])->middleware('verify.api');

    Route::get("/verification/all", [AppointmentVerificationController::class, "allVerification"])->middleware('verify.api');

    Route::get("/verification/find", [AppointmentVerificationController::class, "findVerification"])->middleware('verify.api');

    Route::patch("/verification/update", [AppointmentVerificationController::class, "updateVerification"])->middleware('verify.api');

    Route::delete("/verification/delete", [AppointmentVerificationController::class, "deleteVerification"])->middleware('verify.api');
// });


Route::post('/location/create', [UserLocationController::class, "locationCreateOrUpdate"])->middleware('verify.api');

Route::get('/location/all', [UserLocationController::class, "getlocation"])->middleware('verify.api');














































































/* usefull article

https://www.twilio.com/en-us/blog/customize-email-verification-password-resets-laravel

*/