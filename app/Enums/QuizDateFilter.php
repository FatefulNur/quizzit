<?php

namespace App\Enums;

enum QuizDateFilter: string
{
    case AVAILABLE = 'available';
    case EXPIRED = 'expired';

    public function getLabel()
    {
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::EXPIRED => 'Expired',
        };
    }
}
