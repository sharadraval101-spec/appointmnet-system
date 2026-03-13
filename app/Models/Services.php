<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_image',
        'service_name',
        'description',
    ];

    protected $casts = [
        'service_image' => 'string',
        'service_name'  => 'string',
        'description'   => 'string',
    ];
}
