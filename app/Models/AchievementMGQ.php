<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementMGQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mgq_id',
        'level',
        'score',
        'evaluated',
    ];
}
