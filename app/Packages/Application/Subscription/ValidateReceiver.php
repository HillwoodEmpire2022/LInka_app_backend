<?php

namespace App\Packages\Application\Subscription;
use App\Packages\Application\Chatting\Send\ChattingRequest;
use Illuminate\Support\Facades\DB;


class ValidateReceiver{

    protected $receiverID;
    

    public function __construct(ChattingRequest $chattingRequest)
    {
        $this->receiverID = $chattingRequest->receiverID();
    }

    public function receiverValidation(){

        $packageName = DB::selectOne("SELECT users.name AS receiverName, SubscriptionLinka.packageName
                                    FROM SubscriptionLinka INNER JOIN SubscriptionLinkaMembersType
                                    ON SubscriptionLinkaMembersType.subscription_type_linka_id
                                    = SubscriptionLinka.id INNER JOIN LinkaUsers ON 
                                    SubscriptionLinkaMembersType.linka_user_id = LinkaUsers.id INNER JOIN
                                    users AS users ON LinkaUsers.user_id = users.id
                                    WHERE LinkaUsers.id = ?", [$this->receiverID]);
        

        if(is_null($packageName)){

            return "Make Sure You Subscribed to Linka.";
        }
        else{
            return [$packageName->receiverName, $packageName->packageName];
        }
       
        
    }
}