<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BaseArmorResource\Pages;
use App\Filament\Resources\BaseArmorResource\RelationManagers;
use App\Models\Items\BaseArmor;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BaseArmorResource extends Resource
{
    protected static ?string $model = BaseArmor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(50),
                TextInput::make('min_str')->numeric(),
                TextInput::make('armor_bonus')->numeric(),
                TextInput::make('maneuver_bonus')->numeric()->step(1),
                TextInput::make('weight')->numeric()->step(0.1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('min_str'),
                TextColumn::make('armor_bonus'),
                TextColumn::make('maneuver_bonus'),
                TextColumn::make('weight'),
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
            'index' => Pages\ListBaseArmors::route('/'),
            'create' => Pages\CreateBaseArmor::route('/create'),
            'edit' => Pages\EditBaseArmor::route('/{record}/edit'),
        ];
    }
}
