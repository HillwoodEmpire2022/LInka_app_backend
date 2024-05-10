<?php

namespace App\Packages\Application\Chatting\Audio\Send;

use App\Packages\Application\Chatting\Audio\Send\AudioChattingRequest;
use App\Packages\Infrastructure\VoiceMessageRepository;
use App\Packages\Infrastructure\ChatVerification;
use App\Packages\Application\Subscription\ValidateSender;
use App\Packages\Application\Subscription\ValidateReceiver;
use App\Packages\Infrastructure\NotificationRepository;
use App\Packages\Infrastructure\ConversationRepository;


class AudioChattingService
{

    protected $audioUrl;
    protected $senderID;
    protected $receiverID;
    protected $conversationID;
    protected $messageRepository;
    protected $validateSender;
    protected $validateReceiver;
    protected $chattingVerification;
    protected $senderValidation;
    protected $receiverValidation;
    protected $validatedSenderIDPackageName;
    protected $validatedReceiverIDPackageName;
    protected $notificationRepository;
    protected $conversationRepository;



    public function __construct(AudioChattingRequest $request, NotificationRepository $notificationRepository, ConversationRepository $conversationRepository, VoiceMessageRepository $messageRepository, ValidateSender $validateSender, ValidateReceiver $validateReceiver, ChatVerification $chattingVerification)
    {

        $this->audioUrl = $request->audioUrl();
        $this->senderID = $request->senderID();
        $this->receiverID = $request->receiverID();
        $this->conversationID = $request->convoID();
        $this->messageRepository = $messageRepository;
        $this->validateSender = $validateSender;
        $this->validateReceiver = $validateReceiver;
        $this->chattingVerification = $chattingVerification;
        $this->notificationRepository = $notificationRepository;
        

        $this->validatedSenderIDPackageName = $this->validateSender->senderValidation($this->senderID);

        $this->validatedReceiverIDPackageName = $this->validateReceiver->receiverValidation($this->receiverID);

        $this->senderValidation = $this->chattingVerification->senderValidation($this->senderID);

        $this->receiverValidation = $this->chattingVerification->receiverValidation($this->receiverID);

        $this->conversationRepository = $conversationRepository->createConversation($this->conversationID, $this->validatedReceiverIDPackageName[0]);
    }


    public function AudioCreatechatting()
    {
        if ($this->validatedSenderIDPackageName[1] == 'Free' && $this->validatedReceiverIDPackageName[1] == 'Free') {

            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->AudioCreateMessage($this->audioUrl, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
              

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "You Both have Free Subscription and you're Verified"
                ]);
                
            } else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status'=>"Make sure that You Both are Verified to your Free subscription"
                ]);
            }
        } elseif ($this->validatedSenderIDPackageName[1] == 'Monthly' && $this->validatedReceiverIDPackageName[1] == 'Free') {

            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->AudioCreateMessage($this->audioUrl, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
              
                

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "Your Subscriptions are Verified"
                ]);
            } else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status' => "It seems like One of You or Both are not Verified to your Subscription"
                ]);
            }
        } elseif ($this->validatedSenderIDPackageName[1] == 'Monthly' && $this->validatedReceiverIDPackageName[1] == 'Monthly') {

            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->AudioCreateMessage($this->audioUrl, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
               
              

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "Your subscriptions are Verified"
                ]);
            } else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status' => "Make sure you both Verified to your MONTHLY package."
                ]);
            }
        } elseif ($this->validatedSenderIDPackageName[1] == 'Free' && $this->validatedReceiverIDPackageName[1] == 'Monthly') {

            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->AudioCreateMessage($this->audioUrl, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);

                

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "Your subscriptions are Verified"
                ]);
            } else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status' => "It seems like One of You or Both are not Verified to your Subscription"
                ]);
            }
        } else {
            return "Make sure you Both have Subscription";
        }
    }
}
