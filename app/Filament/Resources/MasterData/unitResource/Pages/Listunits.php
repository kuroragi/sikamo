<?php

namespace App\Filament\Resources\MasterData\unitResource\Pages;

use App\Filament\Resources\MasterData\unitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class Listunits extends ListRecords
{
    protected static string $resource = unitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
