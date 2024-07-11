<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupConversationNoti extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'audience_id',
        'is_seen'
    ];
}
