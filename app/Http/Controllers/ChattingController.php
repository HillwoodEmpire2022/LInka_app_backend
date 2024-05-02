<?php

namespace App\Http\Controllers;

use App\Packages\Application\Chatting\Send\ChattingService;
use App\Packages\Application\Chatting\Send\ChattingRequest;
use App\Packages\Application\Chatting\List\ChattListRequest;
use App\Packages\Application\Chatting\List\ChattListService;
use App\Packages\Application\Chatting\Delete\DeleteChatRequest;
use App\Packages\Application\Chatting\Delete\DeleteChatService;
use App\Packages\Application\Chatting\Update\UpdateChatRequest;
use App\Packages\Application\Chatting\Update\UpdateChatService;
use Illuminate\Http\Request;


class ChattingController extends Controller

{

    public function createchatting(Request $request, ChattingService $chattingService)
    {

        $chattingRequest = new ChattingRequest($request);
        return $chattingService->createchatting($chattingRequest);
    }

    public function chattingList(Request $request, ChattListService $chattListService)
    {

        $chattListRequest = new ChattListRequest($request);
        return $chattListService->chattlist($chattListRequest);
    }

    public function deletingChat(Request $request, DeleteChatService $deleteChatService)
    {

        $deleteChatRequest = new DeleteChatRequest($request);
        return $deleteChatService->deleteChat($deleteChatRequest);
    }

    public function updatingChat(Request $request, UpdateChatService $updateChatService){

        $updateChatRequest = new UpdateChatRequest($request);
        return $updateChatService->updateChat($updateChatRequest);
    }
}
