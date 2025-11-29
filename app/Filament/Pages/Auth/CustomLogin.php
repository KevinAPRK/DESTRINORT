<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    public function getHeading(): string | Htmlable
    {
        return '';
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                $this->getEmailFormComponent()
                    ->label('Correo electrónico'),
                $this->getPasswordFormComponent()
                    ->label('Contraseña'),
                $this->getRememberFormComponent()
                    ->label('Recuérdame'),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction()
                ->label('Iniciar sesión'),
        ];
    }
}
