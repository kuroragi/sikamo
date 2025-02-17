<?php

namespace App\Filament\Resources\MasterData\unitResource\Pages;

use App\Filament\Resources\MasterData\unitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Editunit extends EditRecord
{
    protected static string $resource = unitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
