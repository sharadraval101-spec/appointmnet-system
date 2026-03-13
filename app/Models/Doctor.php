<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'specialization',
        'qualification',
        'experience',
        'description',
        'phone',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays and JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Automatically hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * Define relationships (if any).
     * Example: A doctor may have many appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Example: A doctor may have many schedules.
     */
    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
