<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'LinkerUserID',
        'Appointment_date',
        'TherapyType',
        'Therapist_Assigned',
        'Appointment_Status',
    ];
}
