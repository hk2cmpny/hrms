<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CalendarInfo;
use App\Filament\Widgets\CalendarWidget;
use Filament\Pages\Page;

class Calender extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.pages.calender';
    protected function getHeaderWidgets(): array
    {
        return [
            CalendarInfo::class,
            CalendarWidget::class,
        ];
    }

}
