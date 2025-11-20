<?php

namespace App\Filament\Resources\Resenas\Pages;

use App\Filament\Resources\Resenas\ResenaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewResena extends ViewRecord
{
    protected static string $resource = ResenaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
