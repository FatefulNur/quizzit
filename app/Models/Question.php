<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'hint',
        'type',
        'tenant_id',
        'form_id',
        'section_id',
        'is_required',
        'shuffle_options',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'type' => QuestionType::class,
            'is_required' => 'boolean',
            'shuffle_options' => 'boolean',
            'order_index' => 'integer',
        ];
    }
}
