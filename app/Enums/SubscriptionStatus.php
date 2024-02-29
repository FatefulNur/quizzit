<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SubscriptionStatus: string implements HasColor, HasLabel
{
    case ON_TRIAL = 'on_trial';
    case ACTIVE = 'active';
    case PAUSED = 'paused';
    case PAST_DUE = 'past_due';
    case UNPAID = 'unpaid';
    case CANCELLED = 'cancelled';
    case EXPIRED = 'expired';

    public function getLabel(): string
    {
        return match ($this) {
            self::ON_TRIAL => 'On Trial',
            self::ACTIVE => 'Active',
            self::PAUSED => 'Paused',
            self::PAST_DUE => 'Past Due',
            self::UNPAID => 'Unpaid',
            self::CANCELLED => 'Cancelled',
            self::EXPIRED => 'Expired',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ON_TRIAL => 'info',
            self::ACTIVE => 'success',
            self::PAUSED => 'warning',
            self::PAST_DUE => 'danger',
            self::UNPAID => 'danger',
            self::CANCELLED => 'secondary',
            self::EXPIRED => 'dark',
        };
    }
}
