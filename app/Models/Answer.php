<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'correct',
        'user_id',
        'user_response_id',
        'question_id',
        'option_id',
    ];
}
