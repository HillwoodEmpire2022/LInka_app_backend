<?php

namespace App\Packages\Infrastructure;
use App\Packages\Application\Chatting\Send\ChattingRequest;
use App\Models\LinkaUsers;

class LinkaUsersRepository{

    protected $senderID;
    protected $linkaModel;

    public function __construct(ChattingRequest $chattingRequest, LinkaUsers $linkaModel)
    {
        $this->senderID=$chattingRequest->senderID();
        $this->linkaModel=$linkaModel;

    }

    public function find(String $id){
        $senderID = $this->linkaModel::findOrFail($id);

        if($senderID){
            return $senderID;
        }
        else{
            return "Are you Linka User? please Subscribe on Linka Users!!!";
        }
        
    }


}