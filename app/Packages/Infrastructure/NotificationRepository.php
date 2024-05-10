<?php

namespace App\Packages\Infrastructure;

use App\Models\Notification;


class NotificationRepository
{

    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new Notification();
    }

    public function createNotification(String $receiverID)
    {
        Notification::create([
            'user_id' => $receiverID,
            'notificationType' => 'Message',
            'message' => 'You have Unread message'
        ]);
    }
}
