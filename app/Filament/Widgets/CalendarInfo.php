<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CalendarInfo extends Widget
{
    protected static string $view = 'filament.widgets.calendar-info';

    protected int | string | array $columnSpan = 'full';
}
