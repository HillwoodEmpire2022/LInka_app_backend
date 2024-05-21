<?php

namespace App\Packages\Application\Chatting\Pictures\Delete;
use App\Packages\Application\Chatting\Text\Delete\DeleteChatRequest;
use App\Packages\Infrastructure\ImageMessageRepository;


class DeletePictureService{

    protected $deleteChatRequest;
    protected $imageMessageRepository;


    public function __construct(DeleteChatRequest $deleteChatRequest, ImageMessageRepository $imageMessageRepository)
    {
        
        $this->deleteChatRequest = $deleteChatRequest->getID();
        $this->imageMessageRepository = $imageMessageRepository;
    }

    public function deletePictureChat(){

        return $this->imageMessageRepository->deleteChat($this->deleteChatRequest);
    }


}