<?php

namespace App\Packages\Application\Chatting\Text\List;
use App\Packages\Application\Chatting\Text\List\ChattListRequest;
use App\Packages\Infrastructure\MessageRepository;


class ChattListService{


    protected $senderID;
    protected $receiverID;
    protected $messageRepository;

    public function __construct(ChattListRequest $request, MessageRepository $messageRepository)
    {
    
        $this->senderID=$request->senderID();
        $this->messageRepository=$messageRepository;
    }

    public function chattlist()
    {

        return $this->messageRepository->chattlist($this->senderID);
    }
}