<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\Matches;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class MachingService
{
    public function requestMatching(int $matchFrom, int $matchTo)
    {
        $requestMatching = DB::transaction(function () use ($matchFrom, $matchTo) {

            Matches::firstOrCreate([
                "match_id_from" => $matchFrom,
                "match_id_to" => $matchTo,
            ]);

            $notificationType = NotificationType::MATCH;

            Notification::create([
                "user_id" => $matchTo,
                "notificationType" => $notificationType->value,
                "message" => "someone request to matching you , accept the requested",
            ]);
        });

        return $requestMatching;
    }

    public function updateMatching($matchFrom, $matchTo)
    {
        $updateMatching = DB::transaction(function () use ($matchFrom, $matchTo) {

            Matches::where([["match_id_from", $matchFrom], ["match_id_to", $matchTo]])->update([
                "aproved" => true,
            ]);

            $notificationType = NotificationType::MATCH;

            $matchingName = $this->getNameMatchingAccepted($matchTo);

            Notification::create([
                "user_id" => $matchFrom,
                "notificationType" => $notificationType->value,
                "message" => "$matchingName accept your matching request. you can start a new greeting message",
            ]);
        });

        return $updateMatching;
    }

    public function listMatching(int $linkaUser)
    {
        $matching = DB::select("SELECT Profile.profileImagePath, CONCAT(Profile.firstName, ' ', Profile.lastName) AS matchUser,
                                Profile.personalInfo, Matches.aproved
                                FROM Matches
                                INNER JOIN LinkaUsers
                                ON Matches.match_id_from = LinkaUsers.id
                                INNER JOIN Profile ON Profile.linka_user_id = LinkaUsers.id
                                WHERE Matches.match_id_to = ? AND Matches.aproved = 0", [$linkaUser]);

        return $matching;
    }

    public function declineMatching(int $matchFrom, int $matchTo)
    {
        $declineMatching = Matches::where(['match_id_from' => $matchFrom, 'match_id_to' => $matchTo])->first();

        $declineMatching->delete();

        return $declineMatching;
    }

    /**
     * return name profile of user who accept match request
     *
     * @param integer $matchTo
     * @return void
     */
    public function getNameMatchingAccepted(int $matchTo)
    {
        $name = DB::selectOne("SELECT users.name FROM LinkaUsers
                               INNER JOIN users ON LinkaUsers.user_id = users.id WHERE LinkaUsers.id = ?", [$matchTo]);

        return $name->name;
    }
}
