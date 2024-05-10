<?php

namespace App\Packages\Application\Conversation\FindAllConversation;
use App\Packages\Infrastructure\ConversationRepository;



class AllConversationService{

    protected $conversationRepository;

    public function __construct(ConversationRepository $conversationRepository)
    {
        $this->conversationRepository=$conversationRepository;
    }

    public function getAllConvo(){

        return $this->conversationRepository->findAllConvo();
    }

}