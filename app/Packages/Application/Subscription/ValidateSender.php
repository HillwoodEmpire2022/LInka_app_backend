<?php

namespace App\Packages\Application\Subscription;
use App\Packages\Application\Chatting\Send\ChattingRequest;
use Illuminate\Support\Facades\DB;

class ValidateSender{

    protected $senderID;
    

    public function __construct(ChattingRequest $chattingRequest)
    {
        $this->senderID = $chattingRequest->senderID();
    }

    public function senderValidation(){

        $packageName = DB::selectOne("SELECT users.name AS senderName, SubscriptionLinka.packageName
                                    FROM SubscriptionLinka INNER JOIN SubscriptionLinkaMembersType
                                    ON SubscriptionLinkaMembersType.subscription_type_linka_id
                                    = SubscriptionLinka.id INNER JOIN LinkaUsers ON 
                                    SubscriptionLinkaMembersType.linka_user_id = LinkaUsers.id INNER JOIN users AS users
                                    ON LinkaUsers.user_id = users.id
                                    WHERE LinkaUsers.id = ?", [$this->senderID]);
        

        if(is_null($packageName)){

            return "Make Sure You Subscribed to Linka.";
        }
        else{
            return [$packageName->senderName, $packageName->packageName];
        }
       
        
    }
}