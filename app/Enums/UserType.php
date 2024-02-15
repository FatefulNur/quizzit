<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserType: string implements HasColor, HasLabel
{
    case ADMIN = 'admin';
    case USER = 'user';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::USER => 'Regular User',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ADMIN => 'success',
            self::USER => 'warning',
        };
    }
}
