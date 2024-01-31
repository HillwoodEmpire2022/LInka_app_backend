<?php

namespace App\Enums;

enum UserType: string
{
    case Members = "Members";
    case Default = "Default User";
    case SuperAdmin = "Super Admin";
    case Admin = "Admin";
    case Executive = "Executive";
    case Support = "Support";
}
