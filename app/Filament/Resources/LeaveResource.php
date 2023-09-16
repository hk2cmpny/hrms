<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Filament\Resources\LeaveResource\RelationManagers;
use App\Models\Leave;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveResource extends Resource
{
    protected static ?string $model = Leave::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    DatePicker::make('from'),
                    DatePicker::make('to'),
                    Checkbox::make('half'),
                    Textarea::make('reason'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->visible(auth()->user()->is_admin),
                TextColumn::make('from')->label('Date')->date(),
                BadgeColumn::make('half')
                    ->enum([
                        '1' => "Half Day",
                        '0' => "Full Day",
                    ])->label('Type'),
                TextColumn::make('days'),
                BadgeColumn::make('status')
                    ->colors([
                        'secondary',
                        'success' => 1,
                        'danger' => 2,
                    ])
                    ->enum([
                        'Pending',
                        '1' => "Approved",
                        '2' => "Rejected"
                    ]),
                TextColumn::make('reason')->limit(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Approve')
                    ->color('success')
                    ->action(function(Leave $record) {
                        $record->status = 1;
                        $record->save();
                    })->visible(fn (Leave $record) => boolval(
                        auth()->user()->is_admin &&
                        $record->status == 0
                    )),
                Tables\Actions\Action::make('Reject')
                    ->color('danger')
                    ->action(function(Leave $record) {
                        $record->status = 2;
                        $record->save();
                    })->visible(fn (Leave $record) => boolval(
                        auth()->user()->is_admin &&
                        $record->status == 0
                    ))
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }    
}
