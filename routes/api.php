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
    Route::post("/message/send", [ChattingController::class, "createchatting"])->middleware('admin');
    
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
    
// });

Route::prefix("/convo")->group(function(){
    
    Route::get("/find", [ConversationController::class, "findOneConvo"]);

    Route::get('/all', [ConversationController::class, "findAllConvo"]);

    Route::delete('/delete', [ConversationController::class, "deleteConvo"]);
    
});

// Route::prefix("/therapy")->group(function(){

    Route::get("/category/all", [TherapyController::class, "getTherapyCategories"]);

    Route::post("/category/create", [TherapyController::class, "createTherapyCategory"]);

    Route::get("/category/find", [TherapyController::class, "getOneTherapy"]);

    Route::patch("/category/update", [TherapyController::class, "updateTherapy"]);

    Route::delete("/category/delete", [TherapyController::class, "deleteTherapy"]);


    Route::post("/appointment/create", [AppointmentController::class, "createAppointment"]);

    Route::get("/appointment/all", [AppointmentController::class, "getAllAppointment"]);

    Route::get("/appointment/find", [AppointmentController::class, "getOneAppointment"]);

    Route::patch("/appointment/update", [AppointmentController::class, "updateAppointment"]);

    Route::delete("/appointment/delete", [AppointmentController::class, "deleteAppointment"]);


    Route::post("/type/create", [TherapyTypeController::class, "createTherapyType"]);

    Route::get("/type/all", [TherapyTypeController::class, "allTherapyType"]);

    Route::get("/type/find", [TherapyTypeController::class, "findTherapyType"]);

    Route::patch("/type/update", [TherapyTypeController::class, "updateTherapyType"]);

    Route::delete("/type/delete", [TherapyTypeController::class, "deleteTherapyType"]);


    Route::post("/therapist/create", [TherapistController::class, "createTherapist"]);

    Route::get("/therapist/all", [TherapistController::class, "allTherapist"]);

    Route::get("/therapist/one", [TherapistController::class, "findTherapist"]);

    Route::patch("/therapist/update", [TherapistController::class, "updateTherapist"]);

    Route::delete("/therapist/delete", [TherapistController::class, "deleteTherapist"]);
    

    Route::post("/verification/create", [AppointmentVerificationController::class, "createVerification"]);

    Route::get("/verification/all", [AppointmentVerificationController::class, "allVerification"]);

    Route::get("/verification/find", [AppointmentVerificationController::class, "findVerification"]);

    Route::patch("/verification/update", [AppointmentVerificationController::class, "updateVerification"]);

    Route::delete("/verification/delete", [AppointmentVerificationController::class, "deleteVerification"]);
// });


Route::post('/location/create', [UserLocationController::class, "locationCreateOrUpdate"]);

Route::get('/location/all', [UserLocationController::class, "getlocation"]);














































































/* usefull article

https://www.twilio.com/en-us/blog/customize-email-verification-password-resets-laravel

*/