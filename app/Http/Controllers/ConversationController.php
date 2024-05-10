<?php

namespace App\Http\Controllers;

use App\Packages\Application\Conversation\CreateConversation\CreatingConversation;
use App\Packages\Application\Conversation\FindOneConversation\ConversationRequest;
use App\Packages\Application\Conversation\FindOneConversation\ConversationService;
use App\Packages\Application\Conversation\FindAllConversation\AllConversationService;
use App\Packages\Application\Conversation\DeletingConversation\DeletingConversationService;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    
    public function findOneConvo(Request $request , ConversationService $conversationService){

        $conversation = new ConversationRequest($request);
        return $conversationService->findOne($conversation);
        
    }

    public function findAllConvo(AllConversationService $allConversationService){
        
        return $allConversationService->getAllConvo();
    }

    public function deleteConvo(Request $request, DeletingConversationService $deletingConversationService){

        $deleteConvo = new ConversationRequest($request);
        return $deletingConversationService->deleteConvo($deleteConvo);
    }

    public function createConvo(CreatingConversation $creatingConversation){

        return $creatingConversation->createConvo();
    }
}
