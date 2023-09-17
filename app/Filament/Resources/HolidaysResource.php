<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidaysResource\Pages;
use App\Filament\Resources\HolidaysResource\RelationManagers;
use App\Models\Holidays;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidaysResource extends Resource
{
    protected static ?string $model = Holidays::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name'),
                    DatePicker::make('dt')->label('Date'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name'),
                TextColumn::make('dt')
                    ->label('Date')
                    ->date(config('tables.date_format') . " - l"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHolidays::route('/create'),
            'edit' => Pages\EditHolidays::route('/{record}/edit'),
        ];
    }    
}
