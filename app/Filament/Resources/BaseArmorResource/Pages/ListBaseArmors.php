<?php

namespace App\Filament\Resources\BaseArmorResource\Pages;

use App\Filament\Resources\BaseArmorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaseArmors extends ListRecords
{
    protected static string $resource = BaseArmorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
