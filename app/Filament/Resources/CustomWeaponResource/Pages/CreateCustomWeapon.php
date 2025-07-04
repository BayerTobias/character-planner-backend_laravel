<?php

namespace App\Filament\Resources\CustomWeaponResource\Pages;

use App\Filament\Resources\CustomWeaponResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomWeapon extends CreateRecord
{
    protected static string $resource = CustomWeaponResource::class;
}
