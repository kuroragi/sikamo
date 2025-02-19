<?php

namespace App\Filament\Resources\MasterData\UnitConvertionGroupResource\Pages;

use App\Filament\Resources\MasterData\UnitConvertionGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnitConvertionGroups extends ListRecords
{
    protected static string $resource = UnitConvertionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
