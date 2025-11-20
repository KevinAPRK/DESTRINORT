<?php

namespace App\Filament\Resources\Credencials\Pages;

use App\Filament\Resources\Credencials\CredencialResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCredencial extends ViewRecord
{
    protected static string $resource = CredencialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
