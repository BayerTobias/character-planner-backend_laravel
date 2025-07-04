<?php

namespace App\Filament\Resources\CustomWeaponResource\Pages;

use App\Filament\Resources\CustomWeaponResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomWeapons extends ListRecords
{
    protected static string $resource = CustomWeaponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
