<?php

namespace App\Packages\Application\Conversation\FindOneConversation;
use App\Packages\Application\Conversation\FindOneConversation\ConversationRequest;
use App\Packages\Infrastructure\ConversationRepository;



class ConversationService{

    protected $conversationRequest;
    protected $conversationRepository;
    
    
    public function __construct(ConversationRequest $conversationRequest, ConversationRepository $conversationRepository)
    {
        $this->conversationRequest = $conversationRequest->getConvoID();
        $this->conversationRepository = $conversationRepository;
        
    }

    public function findOne(){

        return $this->conversationRepository->findOneConvo($this->conversationRequest);
    }
}