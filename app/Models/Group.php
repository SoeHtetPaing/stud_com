<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mygn',
        'yrgn',
        'type',
        'creater_id',
        'image',
        'mygimg',
        'yrgimg',
        'myid',
        'yrid'
    ];
}
