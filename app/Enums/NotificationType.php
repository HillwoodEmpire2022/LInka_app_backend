<?php

namespace App\Enums;

enum NotificationType: string
{
    case MESSAGE = "message";
    case MATCH = "match";
    case LIKES = "likes";
}
