<?php

namespace App\Services;

use App\Models\LinkaUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    public function registerUser(string $name, string $email, string $password)
    {
        $createUser = DB::transaction(function () use ($name, $email, $password) {

            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password),
            ]);

            LinkaUsers::create([
                "user_id" => $user->id,
                "user_type_id" => 1,
            ]);
        });

        return $createUser;
    }

    public function loginUser(string $email, string $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

            $response = [
                "user" => $user,
                "token" => $token,
                "message" => "Login Successfully",
            ];

            return $response;
        }
    }
}
