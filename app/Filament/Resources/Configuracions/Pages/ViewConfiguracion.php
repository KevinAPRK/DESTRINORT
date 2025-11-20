<?php

namespace App\Filament\Resources\Configuracions\Pages;

use App\Filament\Resources\Configuracions\ConfiguracionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewConfiguracion extends ViewRecord
{
    protected static string $resource = ConfiguracionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
