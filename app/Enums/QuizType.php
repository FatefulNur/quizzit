<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum QuizType: string implements HasColor, HasLabel, HasIcon
{
    case PRIVATE = 'private';
    case PUBLIC = 'public';

    public function getLabel(): string
    {
        return match ($this) {
            self::PRIVATE => 'Private',
            self::PUBLIC => 'Public',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PRIVATE => 'danger',
            self::PUBLIC => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::PRIVATE => 'heroicon-m-x-mark',
            self::PUBLIC => 'heroicon-m-check',
        };
    }
}
