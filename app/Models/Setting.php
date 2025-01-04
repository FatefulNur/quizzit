<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'confirmation_message',
        'tenant_id',
        'form_id',
        'allow_submissions',
        'enable_autosave_responses',
        'shuffle_questions',
        'enable_single_submission',
        'allow_submission_edits',
        'is_quiz',
        'quiz_settings',
    ];

    protected function casts(): array
    {
        return [
            'allow_submissions' => 'boolean',
            'enable_autosave_responses' => 'boolean',
            'shuffle_questions' => 'boolean',
            'enable_single_submission' => 'boolean',
            'allow_submission_edits' => 'boolean',
            'is_quiz' => 'boolean',
            'quiz_settings' => 'array',
        ];
    }
}
