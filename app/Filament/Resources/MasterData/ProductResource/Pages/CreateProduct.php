<?php

namespace App\Filament\Resources\MasterData\ProductResource\Pages;

use App\Filament\Resources\MasterData\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
