<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

     protected $guarded = [];

    // protected $fillable = [
    //     'user_id','firstName','lastName','nickName','age','gender',
    //     'country','height','weight','personalInfo',
    //     'sexualOrientation','lookingFor','lookingDescription','profileImagePath',
    //     'deleted_by','deleted_at'
    // ] ;

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function attachments()
    {
        return $this->hasMany(ProfileAttachment::class);
    }
    public function isOwner($userId)
    {
        return $this->user_id == $userId;
    }

    public function reactions():HasMany
    {
        return $this->hasMany(ProfileReaction::class);
    }
}
