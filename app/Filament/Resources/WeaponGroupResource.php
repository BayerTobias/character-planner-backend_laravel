<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeaponGroupResource\Pages;
use App\Filament\Resources\WeaponGroupResource\RelationManagers;
use App\Models\Items\WeaponGroup;
use Filament\Forms;
use Filament\Forms\Components\TextInput;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;


use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeaponGroupResource extends Resource
{
    protected static ?string $model = WeaponGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->length(25)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListWeaponGroups::route('/'),
            'create' => Pages\CreateWeaponGroup::route('/create'),
            'edit' => Pages\EditWeaponGroup::route('/{record}/edit'),
        ];
    }
}
