<?php

namespace App\Filament\Resources\BaseArmorResource\Pages;

use App\Filament\Resources\BaseArmorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaseArmor extends EditRecord
{
    protected static string $resource = BaseArmorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
