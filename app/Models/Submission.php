<?php

namespace App\Models;

use App\Enums\SubmissionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'answer',
        'status',
        'tenant_id',
        'form_id',
        'question_id',
        'respondent_id',
        'option_id',
        'score',
        'is_correct',
    ];

    protected function casts(): array
    {
        return [
            'status' => SubmissionStatus::class,
            'is_correct' => 'boolean',
            'score' => 'integer',
        ];
    }
}
