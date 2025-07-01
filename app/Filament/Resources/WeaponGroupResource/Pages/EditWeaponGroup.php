<?php

namespace App\Filament\Resources\WeaponGroupResource\Pages;

use App\Filament\Resources\WeaponGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeaponGroup extends EditRecord
{
    protected static string $resource = WeaponGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
