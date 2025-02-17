<?php

namespace App\Filament\Resources\MasterData\stockCategoryResource\Pages;

use App\Filament\Resources\MasterData\stockCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListstockCategories extends ListRecords
{
    protected static string $resource = stockCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
