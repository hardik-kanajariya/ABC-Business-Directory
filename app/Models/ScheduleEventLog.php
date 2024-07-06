<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleEventLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'command',
        'description',
        'started_at',
        'finished_at',
        'output',
        'successful',
    ];

    protected array $dates = [
        'started_at',
        'finished_at',
    ];
}
