<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $fillable = [
        'title',
        'start',
        'start_time',
        'end',
        'end_time',
        'color'
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];
} 