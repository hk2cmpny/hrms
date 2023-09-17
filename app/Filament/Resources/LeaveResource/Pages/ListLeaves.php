<?php

namespace App\Filament\Resources\LeaveResource\Pages;

use App\Filament\Resources\LeaveResource;
use App\Models\Scopes\UserWise;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListLeaves extends ListRecords
{
    protected static string $resource = LeaveResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
