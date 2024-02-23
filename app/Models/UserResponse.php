<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserResponse extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'result',
        'user_id',
        'quiz_id',
    ];

    protected $casts = [
        'result' => 'integer',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
