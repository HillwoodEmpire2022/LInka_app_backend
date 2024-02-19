<?php

namespace App\Http\Controllers;

use App\Enums\NotificationType;
use App\Http\Requests\CreateMessageChattingRequest;
use App\Models\ChattingVerification;
use App\Models\Message;
use App\Models\Notification;
use Exception;
use Illuminate\Support\Facades\DB;

class ChattingController extends Controller
{
    public function createChatting(CreateMessageChattingRequest $request, int $senderID, int $receiverID)
    {
        $content = $request->content;

        $createChatting = DB::transaction(function () use ($content, $senderID, $receiverID) {

            try {
                $senderSubscription = $this->validateSenderSubscription($senderID);

                $receiverSubscription = $this->validateReceiverSubscription($receiverID);

                if ($senderSubscription == "Free" && $receiverSubscription == "Free") {

                    Message::create([
                        "sender_id" => $senderID,
                        "receiver_id" => $receiverID,
                        "content" => $content,
                    ]);

                    $notificationType = NotificationType::MESSAGE;

                    Notification::create([
                        "user_id" => $receiverID,
                        "notificationType" => $notificationType->value,
                        "message" => "You havve received a new message",
                    ]);

                    $chatting = $this->listChattingAfterMessage($senderID, $receiverID);
                }

                if ($senderSubscription == "Member") {

                    $receiverPayment = $this->validateReceiverPayment($senderID, $receiverID);

                    if ($receiverPayment == "Paid") {

                        Message::create([
                            "sender_id" => $senderID,
                            "receiver_id" => $receiverID,
                            "content" => $content,
                        ]);
                    } else {

                        return response()->json(["Please make sure you have subscription of chatting with this member"]);
                    }
                }

                return response()->json([
                    "messsage" => "message sent successfully",
                    "response" => $chatting,
                ]);

            } catch (\Exception $e) {
                $e->getMessage();
            }
        });

        return response()->json($createChatting);
    }

    public function listChattingAfterMessage(int $senderID, int $receiverID)
    {
        $chatMessage = DB::select("SELECT sender.name AS senderName, Message.content
                                   FROM Message
                                   INNER JOIN LinkaUsers AS senderLinka
                                   ON Message.sender_id = senderLinka.id
                                   INNER JOIN LinkaUsers AS receiverLinka
                                   ON Message.receiver_id = receiverLinka.id
                                   INNER JOIN users AS sender ON senderLinka.user_id = sender.id
                                   INNER JOIN users AS receiver ON receiverLinka.user_id = receiver.id
                                   WHERE Message.sender_id = ?
                                   AND Message.receiver_id = ?", [$senderID, $receiverID]);

        return $chatMessage;
    }

    public function validateReceiverPayment(int $senderID, int $receiverID)
    {
        $verificationStatus = ChattingVerification::where('sender_id', $senderID)
            ->where('receiver_id', $receiverID)
            ->get();

        return $verificationStatus->status;
    }

    public function validateSenderSubscription(int $senderID)
    {
        $packageName = DB::selectOne("SELECT SubscriptionLinka.packageName
                                   FROM SubscriptionLinkaMembersType
                                   INNER JOIN SubscriptionLinka
                                   ON SubscriptionLinkaMembersType.subscription_type_linka_id = SubscriptionLinka.id
                                   INNER JOIN LinkaUsers
                                   ON SubscriptionLinkaMembersType.linka_user_id = LinkaUsers.id
                                   WHERE LinkaUsers.id = ?", [$senderID]);

        if (!$packageName) {

            return $packageName->packageName;

        }
        throw new Exception("You don't have any subscription please choose one first");
    }

    public function validateReceiverSubscription(int $receiverID)
    {
        $packageName = DB::selectOne("SELECT SubscriptionLinka.packageName
                                   FROM SubscriptionLinkaMembersType
                                   INNER JOIN SubscriptionLinka
                                   ON SubscriptionLinkaMembersType.subscription_type_linka_id = SubscriptionLinka.id
                                   INNER JOIN LinkaUsers
                                   ON SubscriptionLinkaMembersType.linka_user_id = LinkaUsers.id
                                   WHERE LinkaUsers.id = ?", [$receiverID]);

        return $packageName->packageName;
    }

    public function chattingList(int $userID)
    {
        $chatMessage = DB::select("SELECT Message.content FROM Message
        INNER JOIN LinkaUsers
        ON Message.sender_id = LinkaUsers.id
        WHERE Message.sender_id = ?
        AND Message.receiver_id = ?", [$userID]);

        return $chatMessage;
    }

    public function chattingMessages(int $senderID, int $receiverID)
    {

    }
}
