<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'section',
        'day',
        'start_hour',
        'end_hour',
        'subject_code',
        'subject_name',
        'lecturer_name'
    ];
}
