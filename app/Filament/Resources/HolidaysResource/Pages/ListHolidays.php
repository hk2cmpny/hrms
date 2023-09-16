<?php

namespace App\Filament\Resources\HolidaysResource\Pages;

use App\Filament\Resources\HolidaysResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHolidays extends ListRecords
{
    protected static string $resource = HolidaysResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
