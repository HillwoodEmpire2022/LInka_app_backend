<?php

namespace App\Http\Controllers;

// Text business logic
use App\Packages\Application\Chatting\Text\Send\ChattingRequest;
use App\Packages\Application\Chatting\Text\Send\ChattingService;
use App\Packages\Application\Chatting\Text\List\ChattListRequest;
use App\Packages\Application\Chatting\Text\List\ChattListService;
use App\Packages\Application\Chatting\Text\Delete\DeleteChatRequest;
use App\Packages\Application\Chatting\Text\Delete\DeleteChatService;
use App\Packages\Application\Chatting\Text\Update\UpdateChatRequest;
use App\Packages\Application\Chatting\Text\Update\UpdateChatService;
use App\Packages\Application\Chatting\Text\FindOne\FindOneMessageService;

// Pictures business logic
use App\Packages\Application\Chatting\Pictures\Send\PictureChattingRequest;
use App\Packages\Application\Chatting\Pictures\Send\PictureChattingService;
use App\Packages\Application\Chatting\Pictures\Delete\DeletePictureService;
use App\Packages\Application\Chatting\Pictures\FindOnePicture\FindOnePictureService;

// Audio business logic
use App\Packages\Application\Chatting\Audio\Send\AudioChattingRequest;
use App\Packages\Application\Chatting\Audio\Send\AudioChattingService;
use App\Packages\Application\Chatting\Audio\Delete\DeleteAudioService;
use App\Packages\Application\Chatting\Audio\FindOneAudio\FindOneAudioService;

use Illuminate\Http\Request;


class ChattingController extends Controller

{
    // Text Messages Controllers methods
    public function createchatting(Request $request, ChattingService $chattingService,)
    {
        $chattingRequest = new ChattingRequest($request);
        return $chattingService->createchatting($chattingRequest);
    }

    public function chattingList(Request $request, ChattListService $chattListService)
    {
        $chattListRequest = new ChattListRequest($request);
        return $chattListService->chattlist($chattListRequest);
    }

    public function oneChattMessage(Request $request, FindOneMessageService $findOneMessageService)
    {
        $findOneMessageRequest = new DeleteChatRequest($request);
        return $findOneMessageService->findOneMessage($findOneMessageRequest);
    }

    public function deletingChat(Request $request, DeleteChatService $deleteChatService)
    {
        $deleteChatRequest = new DeleteChatRequest($request);
        return $deleteChatService->deleteChat($deleteChatRequest);
    }

    public function updatingChat(Request $request, UpdateChatService $updateChatService)
    {
        $updateChatRequest = new UpdateChatRequest($request);
        return $updateChatService->updateChat($updateChatRequest);
    }

    // Picture Messages Controllers methods
    public function pictureChatting(Request $request, PictureChattingService $pictureChattingService)
    {
        $pictureChattingRequest = new PictureChattingRequest($request);
        return $pictureChattingService->pictureCreatechatting($pictureChattingRequest);
    }

    public function deletingPictureChat(Request $request, DeletePictureService $deletePictureService)
    {
        $deletePictureRequest = new DeleteChatRequest($request);
        return $deletePictureService->deletePictureChat($deletePictureRequest);
    }

    public function findOnePicture(Request $request, FindOnePictureService $findOnePictureService)
    {
        $findOnePictureRequest = new DeleteChatRequest($request);
        return $findOnePictureService->findOnePicture($findOnePictureRequest);
    }

    // Audio Messages Controllers methods
    public function AudioChatting(Request $request, AudioChattingService $audioChattingService)
    {
        $audioChattingRequest = new AudioChattingRequest($request);
        return $audioChattingService->AudioCreatechatting($audioChattingRequest);
    }

    public function findOneAudiChat(Request $request, FindOneAudioService $findOneAudioService)
    {
        $findOneAudioRequest = new DeleteChatRequest($request);
        return $findOneAudioService->findOneAudio($findOneAudioRequest);
    }

    public function deletingAudioChatt(Request $request, DeleteAudioService $deleteAudioService)
    {
        $deleteAudioRequest = new DeleteChatRequest($request);
        return $deleteAudioService->deleteAudioChat($deleteAudioRequest);
    }







    

   
}
