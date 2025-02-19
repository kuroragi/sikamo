<?php

namespace App\Filament\Resources\MasterData\InstansiResource\Pages;

use App\Filament\Resources\MasterData\InstansiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstansis extends ListRecords
{
    protected static string $resource = InstansiResource::class;

    // protected static string $view = 'filament.resources.instansi-resource.pages.instansi-main-page';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
