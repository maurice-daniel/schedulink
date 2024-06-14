<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_name',
        'subject',
        'section',
        'room',
        'start_time',
        'end_time',
        'days',
    ];

    protected $casts = [
        'days' => 'array',
    ];
}
