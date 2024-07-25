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
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TherapyTypeController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\AppointmentVerificationController;
use App\Http\Controllers\UserLocationController;

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
    });});

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



Route::post('/login', [AuthController::class, 'Login']);
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/profile/forgot-password',[AuthController::class,'forgot']);
Route::post('/profile/reset-password',[AuthController::class,'ResetPassword']);

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);


// Route::prefix("/chatting")->group(function() {

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