<?php

namespace App\Packages\Application\Chatting\Delete;
use App\Packages\Application\Chatting\Delete\DeleteChatRequest;
use App\Packages\Infrastructure\MessageRepository;


class DeleteChatService{

    protected $messageRepository;
    protected $messageID;

    public function __construct(MessageRepository $messageRepository, DeleteChatRequest $deleteChatRequest)
    {
        $this->messageRepository=$messageRepository;
        $this->messageID=$deleteChatRequest->getID();
    }

    public function deleteChat(){
        return $this->messageRepository->deleteChat($this->messageID);
    }
}