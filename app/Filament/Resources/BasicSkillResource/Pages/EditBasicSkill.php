<?php

namespace App\Filament\Resources\BasicSkillResource\Pages;

use App\Filament\Resources\BasicSkillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBasicSkill extends EditRecord
{
    protected static string $resource = BasicSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
