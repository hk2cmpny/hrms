<?php

namespace App\Filament\Widgets;

use App\Models\Holidays;
use App\Models\Leave;
use App\Models\Scopes\UserWise;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    
    /**
     * Return events that should be rendered statically on calendar.
     */
    public function getViewData(): array
    {
        $leaves = Leave::where('status', '<>', 2)
            ->withoutGlobalScope(UserWise::class)
            ->get()
            ->map(fn($l) => ([
                'title' => $l->user->name,
                'start' => $l->from,
                'end' => $l->to,
                'color' => match($l->status) {
                    1 => config('filament-fullcalendar.leaves.color'),
                    default => config('filament-fullcalendar.leaves_requested.color'),
                }
            ]))
            ->toArray();

        $holidays = Holidays::all()->map(fn($h) => ([
            'title' => $h->name,
            'start' => $h->dt,
            'end' => $h->dt,
            'color' => config('filament-fullcalendar.holiday.color'),
        ]))->toArray();

        return [
            ...$leaves,
            ...$holidays,
        ];
    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        return [];
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(?array $event = null): bool
    {
        // dd($event);
        return true;
    }

    public static function canView(?array $event = null): bool
    {
        return true;
    }
}
