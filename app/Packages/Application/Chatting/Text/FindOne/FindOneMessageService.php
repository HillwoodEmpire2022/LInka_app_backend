<?php

namespace App\Packages\Application\Chatting\Text\FindOne;

use App\Packages\Application\Chatting\Text\Delete\DeleteChatRequest;
use App\Packages\Infrastructure\MessageRepository;



class FindOneMessageService{

    protected $deleteChatRequest;
    protected $messageRepository;


    public function __construct(DeleteChatRequest $deleteChatRequest, MessageRepository $messageRepository)
    {
        $this->deleteChatRequest = $deleteChatRequest->getID();
        $this->messageRepository = $messageRepository;
    }

    public function findOneMessage(){

        return $this->messageRepository->findOneMessage($this->deleteChatRequest);
    }
}