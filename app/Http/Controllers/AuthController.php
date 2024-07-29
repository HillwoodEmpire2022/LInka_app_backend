<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;
// use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\table;

// use App\Packages\Application\SignUp\RegisterRequest;
// use App\Packages\Application\SignUp\RegisterService;
// use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
  

    public function register(Request $request){

    /* The code starts by validating all the required registration
     fields before registering the user.
        1. A valid email address that is unique.
        2. A password with a minimum of 8 characters.
        3. A password_confirmation field to retype your password.
    If registration is successful, an email is sent with a 6-digit 
    PIN to the registered email address
    for email verification and a token is returned in the response.
    This token is used to make any 
    future, authorized requests. */

        $validator = Validator::make($request->all(), [
            'name'=>['required', 'string', 'max:200'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()){
            return new JsonResponse(['Success'=>'Failed to Register', 'message'=>$validator->errors()], 422);
        }

        $user = User::create([
            'name'=>$request->all()['name'],
            'email'=>$request->all()['email'],
            'password'=>Hash::make($request->all()['password']),
        ]);
        if ($user){
            $verify2 = DB::table('password_reset_tokens')->where([
                ['email', $request->all()['email']]
            ]);

            if ($verify2->exists()){
                $verify2->delete();
            }

            $pin = rand(100000, 999999);
            DB::table('password_reset_tokens')
                ->insert([
                    'email'=>$request->all()['email'],
                    'token'=>$pin
                ]);
        }

        Mail::to($request->email)->send(new VerifyEmail($pin));

        $token = $user->createToken('myapptoken')->plainTextToken;

        return new JsonResponse([
            'success'=>'Registered',
            'message'=>'Seccessfully Created User. Please check your Email for a 6-digits pin to verify your email.',
            'token'=>$token
        ], 201);
    }

    public function verifyEmail(Request $request){

        /*
        This method verifies that the 6-digit PIN, retrieved from 
        the request, is linked to an email address reset request for
        the current user. If it is, then the password reset request 
        is deleted and the user's email is marked as being verified. 
        After that, a successful response is returned.

        If a token isn't provided, or the token isn't linked to a password
        request for the user, then the user is redirected back to the 
        AuthController with an applicable error message.
        */

        $validator = Validator::make($request->all(), [
            'token'=>['required'],
        ]);

        if ($validator->fails()){
            return redirect()->back()->with(['message'=>$validator->errors()]);
        }

        $select = DB::table('password_reset_tokens')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token);
        
        if ($select->get()->isEmpty()){
            return new JsonResponse(['success'=>'Failed to Verify', 'message'=>'Invalid PIN'], 400);
        }

        $select = DB::table('password_reset_tokens')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token)
            ->delete();
        
        $user = User::find(Auth::user()->id);
        $user->email_verified_at = Carbon::now()->getTimestamp();
        $user->save();

        return new JsonResponse(['success'=>'Verified', 'message'=>'Your Email is Verified'], 200);
    }


    public function resendPin(Request $request){

        /* 
        If the 6-digit password reset PIN expires, the user may want to request another one.

        The code starts off by checking that the submitted email address is valid. 
        If it is and it's already linked to a password reset request, then the 
        matching password reset request is deleted.
        Following that, a new token is generated and, along with the email address, 
        used to create a new password reset request. If the request is created successfully, 
        then the token is emailed to the user. In addition, a JSON response informs the user 
        that they will receive an email with the reset token.
        */

        $validator = Validator::make($request->all(), [
            'email'=>['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()){
            return new JsonResponse(['success'=>'Failed to Send Pin', 'message'=>$validator->errors()], 422);
        }

        $verify = DB::table('password_reset_tokens')->where([
            ['email', $request->all()['email']]
        ]);

        if ($verify->exists()){
            $verify->delete();
        }

        $token = random_int(100000, 999999);
        $password_reset = DB::table('password_reset_tokens')->insert([
            'email'=>$request->all()['email'],
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);

        if ($password_reset){
            Mail::to($request->all()['email'])->send(new VerifyEmail($token));
            return new JsonResponse([
                'success'=>'Sent',
                'message'=>'A Verification mail has been Resent'
            ], 200);
        }
    }

    
    public function login(Request $request){

        /*
        The login() method requires an email address and a password. 
        The email address must be both valid and linked to the password before 
        a user is successfully logged in. After a successful login, a new 
        token is assigned to the user to make unauthorized requests.
        */

        $validator = Validator::make($request->all(), [
            'email'=>['required', 'string', 'email', 'max:255'],
            'password'=>['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()){
            return new JsonResponse(['success'=>'Failed', 'message'=>$validator->errors()], 422);
        }

        $user = User::where('email', $request->all()['email'])->first();
        if (!$user || !Hash::check($request->all()['password'], $user->password)){
            return new JsonResponse([
                'success'=>'Not Logged In',
                'message'=>'Username or Password are Invalid credentials. Try again'
            ], 400);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return new JsonResponse([
            'success'=>'Successfully Logged in',
            'token'=>$token
        ], 200);
    }



    public function logout(Request $request){

        /*
        The logout() method deletes the user's tokens so that they won't 
        have authorized access until they log in again to obtain a new token.
        */

        $request->user()->currentAccessToken()->delete();
        return new JsonResponse([
            'success'=>'Logged out',
            'message'=>'Successfully Logged out'
        ], 200);

    }


    public function forgotPassword(Request $request){


        /*
        The forgotPassword() method validates the email address sent in the request and checks 
        if it is linked to an existing user, and if it is linked to a reset password request. 
        If it is, then the current reset password request is replaced with another one. 
        It then finishes up by mailing a reset password email to the user, which contains the 
        reset password pin.
        */

        $validator = Validator::make($request->all(), [
            'email'=>['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()){
            return new JsonResponse(['success'=>'Failed', 'message'=>$validator->errors()], 422);
        }

        $verify = User::where('email', $request->all()['email'])->exists();
        if ($verify){
            $verify2 = DB::table('password_reset_tokens')->where([
                ['email', $request->all()['email']]
            ]);

            if ($verify2->exists()){
                $verify2->delete();
            }

            $token = random_int(100000, 999999);
            $password_reset = DB::table('password_reset_tokens')->insert([
                'email'=>$request->all()['email'],
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);

            if ($password_reset){
                Mail::to($request->all()['email'])->send(new ResetPassword($token));

                return new JsonResponse([
                    'success'=>'Sent',
                    'message'=>'Please check your Email for a 6-digits  PIN'
                ], 200);
            } else{
                return new JsonResponse([
                    'success'=>'Failed',
                    'message'=>'This Email Does not Exist'
                ], 400);
            }

        }else{
            return "the email doesn't exist in our system";
        }
    }


    public function verifyPin(Request $request){

        /*
        This method requires the user's email address and the 6-digit PIN sent to them, 
        after the user requested to reset their password. If the pin hasn't expired and is 
        linked to a reset password request with the users' email address, the user is allowed 
        to reset their password. Otherwise an applicable error message is returned.
        */

        $validator = Validator::make($request->all(), [
            'email'=>['required', 'string', 'email', 'max:255'],
            'token'=>['required'],
        ]);

        if ($validator->fails()){
            return new JsonResponse(['success'=>'Failed', 'message'=>$validator->errors()], 422);
        }

        $check = DB::table('password_reset_tokens')->where([
            ['email', $request->all()['email']],
            ['token', $request->all()['token']],
        ]);

        if ($check->exists()){
            $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
            if ($difference > 300){
                return new JsonResponse(['success'=>'Failed', 'message'=>'Your Token has been Expired'], 400);
            }

            $delete = DB::table('password_reset_tokens')->where([
                ['email', $request->all()['email']],
                ['token', $request->all()['token']],
            ])->delete();

            return new JsonResponse([
                'success'=>'True',
                'message'=>'You can Reset your password now'
            ], 200);
        }else{
            return new JsonResponse([
                'success'=>'Failed',
                'message'=>'Invalid token'
            ], 401);
        }
    }


    public function resetPassword(Request $request){

        /*
        the resetPassword() method allows the user to reset their password
        */

        $validator = Validator::make($request->all(), [
            'email'=>['required', 'string', 'email', 'max:255'],
            'password'=>['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()){
            return new JsonResponse(['message'=>'Failed', 'message'=>$validator->errors()], 422);
        }

        $user = User::where('email', $request->email);
        $user->update([
            'password'=>Hash::make($request->password)
        ]);

        $token = $user->first()->createToken('myapptoken')->plainTextToken;

        return new JsonResponse([
            'success'=>'Password Reset',
            'message'=>'Your Password has been reset Successfully',
            'token'=>$token
        ], 200);
    }
    
   
}
