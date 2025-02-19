<?php

namespace App\Filament\Resources\MasterData\InstansiResource\Pages;

use App\Filament\Resources\MasterData\InstansiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstansi extends EditRecord
{
    protected static string $resource = InstansiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
