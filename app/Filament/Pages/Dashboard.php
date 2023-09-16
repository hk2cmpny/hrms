<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\UserOnline;
use App\Filament\Widgets\UserTimer;
use Filament\Pages\Dashboard as OriginalDashboard;

class Dashboard extends OriginalDashboard
{
    protected function getWidgets(): array
    {
        return [
            UserTimer::class,
            UserOnline::class,
        ];
    }

}
