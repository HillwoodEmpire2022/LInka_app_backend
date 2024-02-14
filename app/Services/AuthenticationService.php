<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\LinkaUsers;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    public function __construct(protected MachingService $maching) {
    }
    public function registerUser(string $name, string $email, string $password)
    {
        $createUser = DB::transaction(function () use ($name, $email, $password) {

            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password),
            ]);

            $linkaUser = LinkaUsers::create([
                "user_id" => $user->id,
                "user_type_id" => 1,
            ]);

            $notificationType = NotificationType::Accounts;

            Notification::create([
                "user_id" => $linkaUser->id,
                "notificationType" => $notificationType->value,
                "message" => "Conglatulations $user->name  ' Account creation successfully created, enjoy the application",
            ]);
        });

        return $createUser;
    }

    public function loginUser(string $email, string $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

            $linkaUser = LinkaUsers::where("user_id", $user->id)->first();

            $notification = DB::select("SELECT Notification.notificationType, Notification.message, Notification.read
                                        FROM Notification
                                        INNER JOIN LinkaUsers ON Notification.user_id = LinkaUsers.id
                                        WHERE LinkaUsers.id = ?", [$linkaUser->id]);

            $matches = $this->maching->listMatching($linkaUser->id);

            $response = [
                "userID" => $linkaUser->id,
                "userName" => $user->name,
                "userEmail" => $user->email,
                "token" => $token,
                "message" => "Login Successfully",
                "notification" => $notification,
                "matches" => $matches
            ];

            return $response;
        }
    }
}
