<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = "conversation";

    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    public function imageMessages()
    {
        return $this->hasMany(ImageMessage::class, 'conversation_id');
    }

    public function voiceMessages()
    {
        return $this->hasMany(VoiceMessage::class, 'conversation_id');
    }
}
