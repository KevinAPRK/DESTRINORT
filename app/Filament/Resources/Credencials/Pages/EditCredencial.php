<?php

namespace App\Filament\Resources\Credencials\Pages;

use App\Filament\Resources\Credencials\CredencialResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCredencial extends EditRecord
{
    protected static string $resource = CredencialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
