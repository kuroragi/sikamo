<?php

namespace App\Filament\Resources\MasterData\CostumerResource\Pages;

use App\Filament\Resources\MasterData\CostumerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCostumers extends ListRecords
{
    protected static string $resource = CostumerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
