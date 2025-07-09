<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BasicSkillResource\Pages;
use App\Filament\Resources\BasicSkillResource\RelationManagers;
use App\Models\skills\BasicSkill;
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

class BasicSkillResource extends Resource
{
    protected static ?string $model = BasicSkill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(25),

                TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(100),

                TextInput::make('first_level_cost')
                    ->label('First lvl cost')
                    ->numeric()
                    ->default(1),

                TextInput::make('second_level_cost')
                    ->label('Second lvl cost')
                    ->numeric()
                    ->nullable(),

                Select::make('characterClass')
                    ->label('Character Class')
                    ->relationship('characterClass', 'name')
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('first_level_cost'),
                TextColumn::make('second_level_cost'),
                TextColumn::make('characterClass.name')
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
            'index' => Pages\ListBasicSkills::route('/'),
            'create' => Pages\CreateBasicSkill::route('/create'),
            'edit' => Pages\EditBasicSkill::route('/{record}/edit'),
        ];
    }
}
