<?php

namespace App\Packages\Application\Chatting\List;
use App\Packages\Application\Chatting\List\ChattListRequest;
use App\Packages\Infrastructure\MessageRepository;


class ChattListService{


    protected $senderID;
    protected $receiverID;
    protected $messageRepository;

    public function __construct(ChattListRequest $request, MessageRepository $messageRepository)
    {
    
        $this->senderID=$request->senderID();
        $this->receiverID=$request->receiverID();
        $this->messageRepository=$messageRepository;
    }

    public function chattlist()
    {

        return $this->messageRepository->chattlist($this->senderID, $this->receiverID);
    }
}