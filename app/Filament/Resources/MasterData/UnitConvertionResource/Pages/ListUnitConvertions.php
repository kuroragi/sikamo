<?php

namespace App\Filament\Resources\MasterData\UnitConvertionResource\Pages;

use App\Filament\Resources\MasterData\UnitConvertionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnitConvertions extends ListRecords
{
    protected static string $resource = UnitConvertionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
