<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'available_from',
        'available_to',
        'start_time',
        'end_time',
        'slot_duration',
        'total_slots',
        'is_available',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
