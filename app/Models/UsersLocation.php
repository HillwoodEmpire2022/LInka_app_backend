<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersLocation extends Model
{
    use HasFactory;

    protected $table = "users_locations";
    protected $fillable = [
        'users_id',
        'latitude',
        'longitude'
    ];
}
