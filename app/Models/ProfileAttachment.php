<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileAttachment extends Model
{

    use HasFactory;
    CONST UPDATED_AT = null;  
    protected $guarded = [];
    
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    
}
