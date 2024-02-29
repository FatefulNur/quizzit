<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity',
        'name',
        'email',
        'city',
        'region',
        'country',
    ];

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }
}
