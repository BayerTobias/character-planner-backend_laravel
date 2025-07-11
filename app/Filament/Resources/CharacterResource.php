<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers;
use App\Models\characters\Character;
use App\Models\skills\BasicSkill;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use \Illuminate\Support\Facades\Log;

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

                Repeater::make('basic_skills')
                    ->label('Basic Skills')
                    ->schema(
                        [
                            Select::make('skill_id')
                                ->label('Skill')
                                ->options(
                                    BasicSkill::with('characterClass')->get()->mapWithKeys(
                                        fn($skill) =>
                                        [
                                            $skill->id => $skill->name . ' (' . $skill->characterClass?->name . ')'
                                        ]
                                    )->toArray()
                                )
                                ->required(),

                            TextInput::make('nodes_skilled')
                                ->label('Nodes Skilled')
                                ->numeric()
                                ->default(0),
                        ]
                    )
                    ->columns(2)
                    ->reorderable(),


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

    // public static function mutateFormDataBeforeSave(array $data)
    // {
    //     $skills = $data['basic_skills'] ?? [];
    //     unset($data['basic_skills']);

    //     session()->put('basic_skills', $skills);

    //     Log::info('mutateFormDataBeforeSave wurde aufgerufen!', $data);

    //     return $data;
    // }

    // public static function afterSave(Form $form)
    // {
    //     /** @var \App\Models\characters\Character */
    //     $character = $form->getModel();

    //     dd($character);

    //     $skills = session()->pull('basic_skills', []);

    //     $syncData = collect($skills)->mapWithKeys(fn($item) => [
    //         $item['skill_id'] => ['nodes_skilled' => $item['nodes_skilled'] ?? 0],
    //     ])->toArray();

    //     Log::info('afterSave wurde aufgerufen!', $syncData);

    //     $character->basicSkills()->sync($syncData);
    // }

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
