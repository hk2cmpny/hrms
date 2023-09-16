<?php

namespace App\Filament\Resources\SlotResource\Pages;

use App\Filament\Resources\SlotResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSlots extends ListRecords
{
    protected static string $resource = SlotResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->orderBy('start','desc');
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
