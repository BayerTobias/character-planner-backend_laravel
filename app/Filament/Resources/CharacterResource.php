<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers;
use App\Models\characters\Character;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(25),

                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required(),

                Select::make('character_race_id')
                    ->label('Race')
                    ->relationship('characterRace', 'name')
                    ->required(),

                Select::make('character_class_id')
                    ->label('Class')
                    ->relationship('characterClass', 'name')
                    ->required(),

                Select::make('baseWeapons')
                    ->label('Base Weapons')
                    ->multiple()
                    ->preload()
                    ->relationship('baseWeapons', 'name'),

                Select::make('baseArmor')
                    ->label('Base Armor')
                    ->relationship('baseArmor', 'name'),


                Fieldset::make('Money')
                    ->relationship('money')
                    ->schema([
                        TextInput::make('gf')->numeric()->label('Goldfalken')->required()->default(0)->minValue(0),
                        TextInput::make('tt')->numeric()->label('Trion Taler')->required()->default(0)->minValue(0),
                        TextInput::make('kl')->numeric()->label('Kupferlinge')->required()->default(0)->minValue(0),
                        TextInput::make('mu')->numeric()->label('Muena')->required()->default(0)->minValue(0),
                    ]),

                TextInput::make('current_lvl')->numeric()->default(1)->required(),
                TextInput::make('attribute_points')->numeric()->default(8)->required(),

                TextInput::make('max_hp')->label('Max HP')->numeric()->required(),
                TextInput::make('current_hp')->label('Curren HP')->numeric()->required(),
                TextInput::make('max_mana')->label('Max Mana')->numeric()->nullable(),
                TextInput::make('current_mana')->label('Current Mana')->numeric()->nullable(),

                TextInput::make('strength_value')->numeric()->required(),
                TextInput::make('strength_bonus')->numeric()->required(),
                TextInput::make('agility_value')->numeric()->required(),
                TextInput::make('agility_bonus')->numeric()->required(),
                TextInput::make('constitution_value')->numeric()->required(),
                TextInput::make('constitution_bonus')->numeric()->required(),
                TextInput::make('intelligence_value')->numeric()->required(),
                TextInput::make('intelligence_bonus')->numeric()->required(),
                TextInput::make('charisma_value')->numeric()->required(),
                TextInput::make('charisma_bonus')->numeric()->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('user.name'),
                TextColumn::make('characterClass.name'),
                TextColumn::make('current_lvl'),

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
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
