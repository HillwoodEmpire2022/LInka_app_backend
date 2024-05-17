<?php

namespace App\Packages\Application\Chatting\Pictures\Send;

use App\Packages\Application\Chatting\Pictures\Send\PictureChattingRequest;
use App\Packages\Infrastructure\ImageMessageRepository;
use App\Packages\Infrastructure\ChatVerification;
use App\Packages\Application\Subscription\ValidateSender;
use App\Packages\Application\Subscription\ValidateReceiver;
use App\Packages\Infrastructure\NotificationRepository;
use App\Packages\Infrastructure\ConversationRepository;


class PictureChattingService
{

    protected $imageUrl;
    protected $senderID;
    protected $receiverID;
    protected $messageRepository;
    protected $senderValidation;
    protected $receiverValidation;
    protected $validatedSenderIDPackageName;
    protected $validatedReceiverIDPackageName;
    protected $notificationRepository;
    protected $conversationIDfromRepository;


    public function __construct(PictureChattingRequest $request, NotificationRepository $notificationRepository, ConversationRepository $conversationRepository, ImageMessageRepository $messageRepository, ValidateSender $validateSender, ValidateReceiver $validateReceiver, ChatVerification $chattingVerification)
    {

        $this->imageUrl = $request->imageUrl();
        $this->senderID = $request->senderID();
        $this->receiverID = $request->receiverID();
        $this->messageRepository = $messageRepository;
       
        $this->notificationRepository = $notificationRepository;

        $this->validatedSenderIDPackageName = $validateSender->senderValidation($this->senderID);

        $this->validatedReceiverIDPackageName = $validateReceiver->receiverValidation($this->receiverID);

        $this->senderValidation = $chattingVerification->senderValidation($this->senderID);

        $this->receiverValidation = $chattingVerification->receiverValidation($this->receiverID);

        $this->conversationIDfromRepository = $conversationRepository->createConversation($this->senderValidation, $this->receiverValidation);
    }

    public function pictureCreatechatting()
    {
        // When Both Sender and Receiver have FREE Subscription
        if ($this->validatedSenderIDPackageName[1] == 'Free' && $this->validatedReceiverIDPackageName[1] == 'Free') {

            // when they are Verified for that subscription
            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->pictureCreateMessage($this->imageUrl, $this->senderValidation, $this->receiverValidation, $this->conversationIDfromRepository);
                $this->notificationRepository->createNotification($this->receiverValidation);
               

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message' => $messageData,
                    'Message Status'=>'Message sent Successfully',
                    'Subscription Status' => "You Both have Free Subscription and you're Verified"
                ]);
                
            } 
            
            // when they are not verified
            else {

                return response([
                    "Sender's name" => $this->validatedSenderIDPackageName[0],
                    "Receiver's name" => $this->validatedReceiverIDPackageName[0],
                    'Message Status'=>'Message Failed to send',
                    'Subscription Status'=>"Make sure that You Both are Verified to your Free subscription"
                ]);
            }
        } 
        
        // When Sender has Monthly Subscription and Receiver has Free
        elseif ($this->validatedSenderIDPackageName[1] == 'Monthly' && $this->validatedReceiverIDPackageName[1] == 'Free') {

            // When they are Verified for that Subscriptions
            if (is_int($this->senderValidation) && is_int($this->receiverValidation)) {

                $messageData = $this->messageRepository->pictureCreateMessage($this->imageUrl, $this->senderValidation, $this->receiverValidation, $this->conversationIDfromRepository);
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

                $messageData = $this->messageRepository->pictureCreateMessage($this->imageUrl, $this->senderValidation, $this->receiverValidation, $this->conversationIDfromRepository);
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

                $messageData = $this->messageRepository->pictureCreateMessage($this->imageUrl, $this->senderValidation, $this->receiverValidation, $this->conversationIDfromRepository);
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
