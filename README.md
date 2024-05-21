

# **Chatting feature**

#### this is the Chatting or Messaging feature amongst the many different features of this App.  
#### this feature consists of different APIs endpoints which are suppossed to work as expected.

## **Feature Structure**
 As the normal messaging App, 2 people will be able to send and recieve the text, audio or image  
 messages. that's means, many messages will be found in one conversations, no message can involve  
 in more than one conversation. when you text a user at the first time, a conversation will be created  
 and then the next time, you will continue to chat in the same conversation created before, that's why  
 I have included the conversation APIs in the chatting feature.


 This feature is built in almost what we call **Clean Architecture Design Pattern**. it means that  
 every single details is separated from the other, that increase the code readability and maintenaince  
 and scalability when you want to work on one functionality. business logics are separated from the   
 database models instances, and also the incoming requests are separeted with the services to serve them  
 that's why you will see a lot of different files imported or exported in a certain file.
 ### Directory structure of this Feature.
    **endpoints**
        LInka_app_backend
         -routes
           -api.php
    **controller**
        App
         -Http
          -Controllers
            -ChattingController.php
            -ConversationController.php
    **chatting feature logic and service**
        Packages/Application
         -Chatting
           -Text
            -Delete
             -DeleteChatrequest.php
             -DeleteChatService.php
            -FindOneChat
             -FindOneMessageService.php
            -List
             -ChatListrequest.php
             -ChatListService.php
            -Update
             -UpdateChatrequest.php
             -UpdateChatService.php
            Send
            (*this is for only the text messages. it should be inside text directory,  
            but for the sake of Developer, I left it there when I was debugging*)  

             -Chattingrequest.php
             -ChattingService.php
            
            Audoi
             -Send
              -AudioChattingrequest.php
              -AudioChattingService.php
             -FindOneAudio
              -FindOneAudioService.php
             -Delete
              -DeleteAudioService.php
            
            Pictures
             -Send
              -PictureChattingrequest.php
              -PictureChattingService.php
             -FindOnePicture
              -FindOnePictureService.php
             -Delete
              -DeletePictureService.php
    
    **chatting feature Database and Models Interaction**
        Packages/Infrastructure
            -Chatverification.php
            -ConversationRepository.php
            -ImageMessageRepository.php
            -LinkaUsersRepository.php
            -MessageRepository.php
            -NotificationRepository.php
            -VoiceMessageRepository.php


 ### More on this Structure
  Most of these classes are built using method and constructore injection. it means that you   
  will face with the injection in each file you can review and that is the best way to use  
  when you're trying to introduce this clean or layerd architecture in your development.



# The following are all endpoints that are in this feature

## **Chatting Endpoints**

 1. ### chatting/message/send 
        (*This is the api for sending a message or just texting to someone*)

        **Controller function**
            createchatting - this method is found in App\Http\Controllers\ChattingController
 2. ### chatting/message/list
        (*This is the api for returning all messages sent by a defined id-user*)

        **Controller function**
            chattingList - this method is found in App\Http\Controllers\ChattingController
 3. ### chatting/message/one
        (*This is the api for returning One message sent by a defined message-id*)

        **Controller function**
            oneChattMessage - this method is found in App\Http\Controllers\ChattingController
 4. ### chatting/message/delete
        (*This is the api for deleting one message  by a defined message-id*)

        **Controller function**
            deletingChat - this method is found in App\Http\Controllers\ChattingController
 5. ### chatting/message/update
        (*This is the api for updating the message sent by a defined message_id*)

        **Controller function**
            updatingChat - this method is found in App\Http\Controllers\ChattingController
 6. ### chatting/audio/send
        (*This is the api for sending  an  Audio message *)

        **Controller function**
            AudioChatting - this method is found in App\Http\Controllers\ChattingController
 7. ### chatting/audio/delete
        (*This is the api for deleting an Audio message defined by a message_id *)

        **Controller function**
            deletingAudioChatt - this method is found in App\Http\Controllers\ChattingController
 8. ### chatting/audio/one
        (*This is the api for returning one Audio message by a message_id *)

        **Controller function**
            findOneAudiChat - this method is found in App\Http\Controllers\ChattingController
 9. ### chatting/picture/send
        (*This is the api for sending a picture message *)

        **Controller function**
            pictureChatting - this method is found in App\Http\Controllers\ChattingController
 10. ### chatting/picture/delete
        (*This is the api for deleting one picture message by a message_id *)

        **Controller function**
            deletingPictureChat - this method is found in App\Http\Controllers\ChattingController
 11. ### chatting/picture/one
        (*This is the api for returning one picture message by a message_id *)

        **Controller function**
            findOnePicture - this method is found in App\Http\Controllers\ChattingController

## **Conversation endpoints**

 1.  ### convo/find
        (*This is the api for returning one conversation by conversation_id *)

        **Controller function**
            findOneConvo - this method is found in App\Http\Controllers\ConversationController
 2.  ### convo/all
        (*This is the api for returning All conversations*)

        **Controller function**
            findAllConvo - this method is found in App\Http\Controllers\ConversationController
 1.  ### convo/delete
        (*This is the api for deleting one conversation by conversation_id *)

        **Controller function**
            deleteConvo - this method is found in App\Http\Controllers\ConversationController




