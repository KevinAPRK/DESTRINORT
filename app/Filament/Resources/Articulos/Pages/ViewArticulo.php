<?php

namespace App\Filament\Resources\Articulos\Pages;

use App\Filament\Resources\Articulos\ArticuloResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArticulo extends ViewRecord
{
    protected static string $resource = ArticuloResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
