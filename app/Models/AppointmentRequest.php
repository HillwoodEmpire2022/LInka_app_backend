<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'Full_name',
        'Age',
        'Location',
        'Gender',
        'Message',
        'Phone_number',
        'TherapyType_needed',
    ];
}
