<?php

namespace App\Packages\Application\Conversation\CreateConversation;
use App\Packages\Application\Conversation\FindOneConversation\ConversationRequest;
use App\Packages\Application\Subscription\ValidateReceiver;
use App\Packages\Infrastructure\ConversationRepository;


class CreatingConversation{

    protected $conversationRequest;
    protected $validateReceiver;
    protected $conversationRepository;

    public function __construct(ConversationRequest $conversationRequest, ValidateReceiver $validateReceiver, ConversationRepository $conversationRepository)
    {
        $this->conversationRequest=$conversationRequest->getConvoID();
        $this->validateReceiver=$validateReceiver->receiverValidation();
        $this->conversationRepository=$conversationRepository;
    }

    public function createConvo(){

        return $this->conversationRepository->createConversation($this->validateReceiver[0], $this->conversationRequest);
    }
}