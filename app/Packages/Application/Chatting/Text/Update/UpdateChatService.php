<?php

namespace App\Packages\Application\Chatting\Text\Update;
use App\Packages\Application\Chatting\Text\Update\UpdateChatRequest;
use App\Packages\Infrastructure\MessageRepository;



class UpdateChatService{

    protected $messageRepository;
    protected $messageID;
    protected $content;

    public function __construct(MessageRepository $messageRepository, UpdateChatRequest $updateChatRequest)
    {
        $this->messageRepository=$messageRepository;
        $this->messageID=$updateChatRequest->getmessageID();
        $this->content= $updateChatRequest->getContent();
    }

    public function updateChat(){

        return $this->messageRepository->updateChatt($this->messageID, ['content'=>$this->content]);
    }
}