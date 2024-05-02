<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChattingVerification extends Model
{
    use HasFactory;

    protected $table = "chatting_verification";

    protected $guarded = [];
}
