<?php

namespace App\Filament\Resources\MasterData\SaleResource\Pages;

use App\Filament\Resources\MasterData\SaleResource;
use App\Livewire\SalesForm;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return SalesForm::make();
    }
}
