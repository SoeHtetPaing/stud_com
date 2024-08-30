<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mynew',
        'yrnew',
        'is_active',
        'lat',
        'creater_id',
        'group_id',
    ];
}
