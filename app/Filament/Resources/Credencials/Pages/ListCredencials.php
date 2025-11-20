<?php

namespace App\Filament\Resources\Credencials\Pages;

use App\Filament\Resources\Credencials\CredencialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCredencials extends ListRecords
{
    protected static string $resource = CredencialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
