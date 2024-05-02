<?php

namespace App\Packages\Application\Chatting\Send;
use App\Packages\Application\Chatting\Send\ChattingRequest;
use App\Packages\Infrastructure\MessageRepository;
use App\Packages\Infrastructure\ChatVerification;
use App\Packages\Application\Subscription\ValidateSender;
use App\Packages\Application\Subscription\ValidateReceiver;


class ChattingService{

    protected $content;
    protected $senderID;
    protected $receiverID;
    protected $messageRepository;
    protected $validateSender;
    protected $validateReceiver;
    protected $chattingVerification;


    public function __construct(
        ChattingRequest $request, 
        MessageRepository $messageRepository, 
        ValidateSender $validateSender,
        ValidateReceiver $validateReceiver,
        ChatVerification $chattingVerification)
    {
        $this->content=$request->content();
        $this->senderID=$request->senderID();
        $this->receiverID=$request->receiverID();
        $this->messageRepository=$messageRepository;
        $this->validateSender=$validateSender;
        $this->validateReceiver=$validateReceiver;
        $this->chattingVerification=$chattingVerification;
    }

    public function createchatting(){

        $validatedSenderIDPackageName=$this->validateSender->senderValidation($this->senderID);
        
        $validatedReceiverIDPackageName=$this->validateReceiver->receiverValidation($this->receiverID);

        if ($validatedSenderIDPackageName[1] == 'Free' && $validatedReceiverIDPackageName[1] == 'Free')
        {
            $messageData = $this->messageRepository->createMessage($this->content, $this->senderID, $this->receiverID);
            
           return response([
            "Sender's name"=>$validatedSenderIDPackageName[0],
            "Receiver's name"=>$validatedReceiverIDPackageName[0],
            'Message'=>$messageData, 
            'Subscription Status'=>"Now it's Free but next Month you will pay"]);
            
        }


        elseif($validatedSenderIDPackageName[1] == 'Monthly' && $validatedReceiverIDPackageName[1] == 'Free')
        {

            $senderValidation=$this->chattingVerification->senderValidation($this->senderID);

            $receiverValidation=$this->chattingVerification->receiverValidation($this->receiverID);

            if (is_int($senderValidation) && is_int($receiverValidation)){

                $messageData = $this->messageRepository->createMessage($this->content, $senderValidation, $receiverValidation);

                return response([
                         "Sender's name"=>$validatedSenderIDPackageName[0],
                         "Receiver's name"=>$validatedReceiverIDPackageName[0],
                         'Message'=>$messageData, 
                         'Subscription Status'=>"Now it's Paid "]);
            }
            else{

                return "It seems like your partner didn't subscribe. Sorry!!";
            }
        }

        else{
             return "You have no Subscription";
         }
    }
    

       

        
    
}