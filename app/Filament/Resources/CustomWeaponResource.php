<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomWeaponResource\Pages;
use App\Filament\Resources\CustomWeaponResource\RelationManagers;
use App\Models\Items\CustomWeapon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomWeaponResource extends Resource
{
    protected static ?string $model = CustomWeapon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->length(25),
                TextInput::make('min_str')->numeric()->nullable(),
                TextInput::make('dmg')->numeric(),
                TextInput::make('attribute')->nullable(),
                TextInput::make('weight')->numeric()->step(0.0),
                TextInput::make('ini_bonus')->numeric(),
                TextInput::make('special')->length(250),

                Select::make('weaponGroups')
                    ->label('Weapon Groups')
                    ->relationship('weaponGroups', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),

                Select::make('character_id')
                    ->label('Character')
                    ->relationship('character', 'name')
                    ->preload()
                    ->searchable()
                    ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('min_str'),
                TextColumn::make('dmg'),
                TextColumn::make('attribute'),
                TextColumn::make('weight'),
                TextColumn::make('ini_bonus'),

                TextColumn::make('weaponGroups.name')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('character.name')

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
            'index' => Pages\ListCustomWeapons::route('/'),
            'create' => Pages\CreateCustomWeapon::route('/create'),
            'edit' => Pages\EditCustomWeapon::route('/{record}/edit'),
        ];
    }
}
