<?php

namespace App\Filament\Resources\MasterData\UserResource\Pages;

use App\Filament\Resources\MasterData\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
