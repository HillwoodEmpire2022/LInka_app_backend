<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

Log::info('Memory usage before processing: ' . memory_get_usage());
// Text business logic
use App\Packages\Application\Chatting\Send\ChattingRequest;
use App\Packages\Application\Chatting\Send\ChattingService;
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
use OpenApi\Attributes as OA;

class ChattingController extends Controller

{
    // Text Messages Controllers methods


    /**
     * @OA\Post(
     *     path="/api/chatting/message/send",
     *     summary="Send a text message",
     *     tags = {"Chatting-Text Messages"},
     *     description="Creates a new chat message",
     *     @OA\Parameter(name="senderID",in="query",description="ID of the sender",required=true),
     *     @OA\Parameter(name="receiverID",in="query",description="ID of the receiver",required=true),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            
     *             @OA\Property(property="content", type="string", description="The message content"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Message created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", description="Error details")
     *         )
     *     )
     * )
     */

    public function createchatting(Request $request, ChattingService $chattingService,)
    {
        $chattingRequest = new ChattingRequest($request);
        return $chattingService->createchatting($chattingRequest);
    }

    /** 
     * @OA\Get(
     *    path="/api/chatting/message/list",
     *    summary="Get Text Messages based on filters",
     *    tags = {"Chatting-Text Messages"},
     *    description="Get messages based on provided filters (optional senderID)",
     *    @OA\Parameter(
     *        name="senderID",
     *        in="query",
     *        description="ID of the sender (optional)",
     *        required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="List of messages matching filters",
     *        @OA\JsonContent(
     *            @OA\Property(property="messages", type="array", description="Array of message objects",
     *         @OA\Items(
     * @OA\Property(
     *    property="id",
     *    type="integer",
     *    description="Unique identifier for the message"
     *),
     * @OA\Property(
     *    property="senderID",
     *    type="integer",
     *    description="ID of the message sender"
     *),
     *@OA\Property(
     *    property="content",
     *    type="string",
     *    description="Message content"
     *),
     *))
     *        )
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Bad request (invalid query parameters)",
     *        @OA\JsonContent(
     *            @OA\Property(property="errors", type="object", description="Error details")
     *        )
     *    )
     *)
     */
    public function chattingList(Request $request, ChattListService $chattListService)
    {
        $chattListRequest = new ChattListRequest($request);
        return $chattListService->chattlist($chattListRequest);
    }


    /** 
     * @OA\Get(
     *    path="/api/chatting/message/one",
     *    summary="Get One Text Messages based on filters",
     *    tags = {"Chatting-Text Messages"},
     *    description="Get message based on provided filters (Message ID)",
     *    @OA\Parameter(
     *        name="message_id",
     *        in="query",
     *        description="ID of the Message ",
     *        required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="the message which matching filters",
     *        @OA\JsonContent(
     *            @OA\Property(property="messages", type="array", description="Array of message objects",
     *         @OA\Items(
     * @OA\Property(
     *    property="id",
     *    type="integer",
     *    description="Unique identifier for the message"
     *),
     * @OA\Property(
     *    property="message_id",
     *    type="integer",
     *    description="ID of the message"
     *),
     *@OA\Property(
     *    property="content",
     *    type="string",
     *    description="Message content"
     *),
     *))
     *        )
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Bad request (invalid query parameters)",
     *        @OA\JsonContent(
     *            @OA\Property(property="errors", type="object", description="Error details")
     *        )
     *    )
     *)
     */

    public function oneChattMessage(Request $request, FindOneMessageService $findOneMessageService)
    {
        $findOneMessageRequest = new DeleteChatRequest($request);
        return $findOneMessageService->findOneMessage($findOneMessageRequest);
    }



    /** 
     * @OA\Delete(
     *    path="/api/chatting/message/delete",
     *    summary="Delete Text Message based on filters",
     *    tags = {"Chatting-Text Messages"},
     *    description="Delete message based on provided filters",
     *    @OA\Parameter(
     *        name="message_id",
     *        in="query",
     *        description="ID of the sender ",
     *        required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Message deleted successfully",
     *        @OA\JsonContent(
     *            @OA\Property(property="messages", type="array", description="Array of message objects",
     * @OA\Items(
     * @OA\Property(
     *    property="id",
     *    type="integer",
     *    description="Unique identifier for the message"
     *),
     * @OA\Property(
     *    property="message_id",
     *    type="integer",
     *    description="ID of the message"
     *),
     *@OA\Property(
     *    property="content",
     *    type="string",
     *    description="Message content"
     *),
     *)
     * )
     *        )
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Bad request (invalid query parameters)",
     *        @OA\JsonContent(
     *            @OA\Property(property="errors", type="object", description="Error details")
     *        )
     *    )
     *)
     */
    public function deletingChat(Request $request, DeleteChatService $deleteChatService)
    {
        $deleteChatRequest = new DeleteChatRequest($request);
        return $deleteChatService->deleteChat($deleteChatRequest);
    }

    /**
     * @OA\Patch(
     *    path="/api/chatting/message/update",
     *    summary="Partially Update message",
     *    tags = {"Chatting-Text Messages"},
     *    description="Updates specific properties of a message",
     *    @OA\Parameter(name="message_id",in="query",description="ID of the message",required=true),
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            
     *             @OA\Property(property="content", type="string", description="The message content"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Message Updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", description="Error details")
     *         )
     * )
     *)
     */
    public function updatingChat(Request $request, UpdateChatService $updateChatService)
    {
        $updateChatRequest = new UpdateChatRequest($request);
        return $updateChatService->updateChat($updateChatRequest);
    }

    // Picture Messages Controllers methods


    /**
     * @OA\Post(
     *     path="/api/chatting/picture/send",
     *     summary="Send a Picture message",
     *     tags = {"Chatting-Picture Messages"},
     *     description="Creates a new Picture message",
     *     @OA\Parameter(name="senderID",in="query",description="ID of the sender",required=true),
     *     @OA\Parameter(name="receiverID",in="query",description="ID of the receiver",required=true),
     *     @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *       @OA\Schema(
     *      @OA\Property(
     *      property="image",
     *      type="file",
     *      description="The image file to upload"
     *)
     *)
     *)
     *),
     *     @OA\Response(
     *         response=201,
     *         description="Message created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", description="Error details")
     *         )
     *     )
     * )
     */

    public function pictureChatting(Request $request, PictureChattingService $pictureChattingService)
    {
        
        $pictureChattingRequest = new PictureChattingRequest($request);
        return $pictureChattingService->pictureCreatechatting($pictureChattingRequest);
    }



    /**
     * @OA\Delete(
     *    path="/api/chatting/picture/delete",
     *    summary="Deleting picture message",
     *    tags = {"Chatting-Picture Messages"},
     *    description="Deleting specific properties of a message",
     *    @OA\Parameter(name="message_id",in="query",description="ID of the message",required=true),
     *     @OA\Response(
     *         response=201,
     *         description="Message Deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", description="Error details")
     *         )
     * )
     *)
     */

    public function deletingPictureChat(Request $request, DeletePictureService $deletePictureService)
    {
        $deletePictureRequest = new DeleteChatRequest($request);
        return $deletePictureService->deletePictureChat($deletePictureRequest);
    }



    /** 
     * @OA\Get(
     *    path="/api/chatting/picture/one",
     *    summary="Get One Picture Messages based on filters",
     *    tags = {"Chatting-Picture Messages"},
     *    description="Get message based on provided filters (Message ID)",
     *    @OA\Parameter(
     *        name="message_id",
     *        in="query",
     *        description="ID of the Message ",
     *        required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="the message which matching filters",
     *        @OA\JsonContent(
     *            @OA\Property(property="messages", type="array", description="Array of message objects",
     *         @OA\Items(
     * @OA\Property(
     *    property="id",
     *    type="integer",
     *    description="Unique identifier for the message"
     *),
     * @OA\Property(
     *    property="message_id",
     *    type="integer",
     *    description="ID of the message"
     *),
     *@OA\Property(
     *    property="content",
     *    type="string",
     *    description="Message content"
     *),
     *))
     *        )
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Bad request (invalid query parameters)",
     *        @OA\JsonContent(
     *            @OA\Property(property="errors", type="object", description="Error details")
     *        )
     *    )
     *)
     */

    public function findOnePicture(Request $request, FindOnePictureService $findOnePictureService)
    {
        $findOnePictureRequest = new DeleteChatRequest($request);
        return $findOnePictureService->findOnePicture($findOnePictureRequest);
    }


    // Audio Messages Controllers methods



    /**
     * @OA\Post(
     *     path="/api/chatting/audio/send",
     *     summary="Send an Audio message",
     *     tags = {"Chatting-Audio Messages"},
     *     description="Creates a new Audio message",
     *     @OA\Parameter(name="senderID",in="query",description="ID of the sender",required=true),
     *     @OA\Parameter(name="receiverID",in="query",description="ID of the receiver",required=true),
     *     @OA\Parameter(name="Conversation_id",in="query",description="ID of the Conversation",required=false),
     *     @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *       @OA\Schema(
     *      @OA\Property(
     *      property="image",
     *      type="file",
     *      description="The image file to upload"
     *)
     *)
     *)
     *),
     *     @OA\Response(
     *         response=201,
     *         description="Message created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", description="Error details")
     *         )
     *     )
     * )
     */

    public function AudioChatting(Request $request, AudioChattingService $audioChattingService)
    {
        $audioChattingRequest = new AudioChattingRequest($request);
        return $audioChattingService->AudioCreatechatting($audioChattingRequest);
    }



    /** 
     * @OA\Get(
     *    path="/api/chatting/audio/one",
     *    summary="Get One Picture Messages based on filters",
     *    tags = {"Chatting-Audio Messages"},
     *    description="Get message based on provided filters (Message ID)",
     *    @OA\Parameter(
     *        name="message_id",
     *        in="query",
     *        description="ID of the Message ",
     *        required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="the message which matching filters",
     *        @OA\JsonContent(
     *            @OA\Property(property="messages", type="array", description="Array of message objects",
     *         @OA\Items(
     * @OA\Property(
     *    property="id",
     *    type="integer",
     *    description="Unique identifier for the message"
     *),
     * @OA\Property(
     *    property="message_id",
     *    type="integer",
     *    description="ID of the message"
     *),
     *@OA\Property(
     *    property="content",
     *    type="string",
     *    description="Message content"
     *),
     *))
     *        )
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Bad request (invalid query parameters)",
     *        @OA\JsonContent(
     *            @OA\Property(property="errors", type="object", description="Error details")
     *        )
     *    )
     *)
     */

    public function findOneAudiChat(Request $request, FindOneAudioService $findOneAudioService)
    {
        $findOneAudioRequest = new DeleteChatRequest($request);
        return $findOneAudioService->findOneAudio($findOneAudioRequest);
    }


    /**
     * @OA\Delete(
     *    path="/api/chatting/audio/delete",
     *    summary="Deleting Audio message",
     *    tags = {"Chatting-Audio Messages"},
     *    description="Deleting specific properties of a message",
     *    @OA\Parameter(name="message_id",in="query",description="ID of the message",required=true),
     *     @OA\Response(
     *         response=201,
     *         description="Message Deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", description="Error details")
     *         )
     * )
     *)
     */

    public function deletingAudioChatt(Request $request, DeleteAudioService $deleteAudioService)
    {
        $deleteAudioRequest = new DeleteChatRequest($request);
        return $deleteAudioService->deleteAudioChat($deleteAudioRequest);
    }
}



