<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'patient_name',
        'email',
        'phone',
        'gender',
        'age',
        'appointment_date',
        'appointment_time',
        'concern',
        'documents',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'documents' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
