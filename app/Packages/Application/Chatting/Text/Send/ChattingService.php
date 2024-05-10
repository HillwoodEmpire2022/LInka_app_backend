<?php

namespace App\Packages\Application\Chatting\Text\Send;

use App\Packages\Application\Chatting\Text\Send\ChattingRequest;
use App\Packages\Infrastructure\MessageRepository;
use App\Packages\Infrastructure\ChatVerification;
use App\Packages\Application\Subscription\ValidateSender;
use App\Packages\Application\Subscription\ValidateReceiver;
use App\Packages\Infrastructure\NotificationRepository;
use App\Packages\Infrastructure\ConversationRepository;


class ChattingService
{

    protected $content;
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



    public function __construct(ChattingRequest $request, NotificationRepository $notificationRepository, ConversationRepository $conversationRepository, MessageRepository $messageRepository, ValidateSender $validateSender, ValidateReceiver $validateReceiver, ChatVerification $chattingVerification)
    {

        $this->content = $request->content();
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


    public function createchatting()
    {

        // When Both Sender and Receiver have FREE Subscription
        if ($this->validatedSenderIDPackageName[1] == 'Free' && $this->validatedReceiverIDPackageName[1] == 'Free') {

            // when they are Verified for that subscription
            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->createMessage($this->content, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
               

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "You Both have Free Subscription and you're Verified"
                ]);
                
            }
            // When One or Both of them are not Verified for the Free subscription
            else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status'=>"Make sure that You Both are Verified to your Free subscription"
                ]);
            }

        // When Sender has Monthly Subscription and Receiver has Free
        } elseif ($this->validatedSenderIDPackageName[1] == 'Monthly' && $this->validatedReceiverIDPackageName[1] == 'Free') {

            // When they are Verified for that Subscriptions
            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->createMessage($this->content, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
                

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "Your Subscriptions are Verified"
                ]);
            } 
            // When One or Both of them are not Verified for the Free subscription
            else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status' => "It seems like One of You or Both are not Verified to your Subscription"
                ]);
            }
        } 
        
        // When Both Sender and Receiver have MONTHLY subscription
        elseif ($this->validatedSenderIDPackageName[1] == 'Monthly' && $this->validatedReceiverIDPackageName[1] == 'Monthly') {

            //when They are Verified for their Subscription
            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->createMessage($this->content, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
              

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "Your subscriptions are Verified"
                ]);
            } 
            
            // When they are not verified
            else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status' => "Make sure you both Verified to your MONTHLY package."
                ]);
            }
        } 
        
        //This is the reverse to second Condition, Sender has FREE subscription and Receiver has MONTHLY
        elseif ($this->validatedSenderIDPackageName[1] == 'Free' && $this->validatedReceiverIDPackageName[1] == 'Monthly') {

            //when they are verified
            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->createMessage($this->content, $this->senderValidation, $this->receiverValidation, $this->conversationRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
                

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "Your subscriptions are Verified"
                ]);
            }
            
            //when they are not verified
            else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status' => "It seems like One of You or Both are not Verified to your Subscription"
                ]);
            }
        } 
        
        // Otherwise
        else {
            return "Make sure you Both have Subscription";
        }
    }
}
