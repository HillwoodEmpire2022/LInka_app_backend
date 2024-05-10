<?php


namespace App\Packages\Application\Chatting\Pictures\FindOnePicture;

use App\Packages\Application\Chatting\Text\Delete\DeleteChatRequest;
use App\Packages\Infrastructure\ImageMessageRepository;


class FindOnePictureService{

    protected $deleteChatRequest;
    protected $imageMessageRepository;


    public function __construct(DeleteChatRequest $deleteChatRequest, ImageMessageRepository $imageMessageRepository)
    {
        $this->deleteChatRequest = $deleteChatRequest->getID();
        $this->imageMessageRepository = $imageMessageRepository;
    }

    public function findOnePicture(){

        return $this->imageMessageRepository->findOnePicture($this->deleteChatRequest);
    }
}