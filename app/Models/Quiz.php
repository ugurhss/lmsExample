<?php

namespace App\Models;

use App\Enums\QuizStatus;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
     protected $fillable = [
        'title',
        'slug',
        'is_active',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'status' => QuizStatus::class, // enum cagırırıyoruz
    ];
}
