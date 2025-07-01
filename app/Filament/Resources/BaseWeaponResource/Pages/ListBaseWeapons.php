<?php

namespace App\Filament\Resources\BaseWeaponResource\Pages;

use App\Filament\Resources\BaseWeaponResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaseWeapons extends ListRecords
{
    protected static string $resource = BaseWeaponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
