<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementNoti extends Model
{
    use HasFactory;

    protected $fillable = [
        'announce_id',
        'audience_id',
        'is_seen'
    ];
}
