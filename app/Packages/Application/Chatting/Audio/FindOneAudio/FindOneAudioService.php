<?php

namespace App\Packages\Application\Chatting\Audio\FindOneAudio;

use App\Packages\Application\Chatting\Text\Delete\DeleteChatRequest;
use App\Packages\Infrastructure\VoiceMessageRepository;


class FindOneAudioService{

    protected $deleteChatRequest;
    protected $voiceMessageRepository;


    public function __construct(DeleteChatRequest $deleteChatRequest, VoiceMessageRepository $voiceMessageRepository)
    {
        $this->deleteChatRequest = $deleteChatRequest->getID();
        $this->voiceMessageRepository = $voiceMessageRepository;
    }

    public function findOneAudio(){

        return $this->voiceMessageRepository->findOneAudio($this->deleteChatRequest);
    }
}