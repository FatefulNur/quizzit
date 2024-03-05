<?php

namespace App\Filament\Widgets;

use App\Models\Quiz;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Registered User', User::query()->count())
                ->icon('heroicon-m-user-group'),
            Stat::make('Total Quiz', Quiz::query()->count())
                ->icon('heroicon-m-user-group'),
        ];
    }
}
