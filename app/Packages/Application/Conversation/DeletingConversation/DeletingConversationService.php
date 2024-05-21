<?php

namespace App\Packages\Application\Conversation\DeletingConversation;
use App\Packages\Application\Conversation\FindOneConversation\ConversationRequest;
use App\Packages\Infrastructure\ConversationRepository;


class DeletingConversationService{

    protected $conversationRequest;
    protected $conversationRepository;

    public function __construct(ConversationRequest $conversationRequest, ConversationRepository $conversationRepository)
    {
        $this->conversationRepository=$conversationRepository;
        $this->conversationRequest=$conversationRequest->getConvoID();
    }

    public function deleteConvo(){

        return $this->conversationRepository->deleteConversation($this->conversationRequest);
    }
}