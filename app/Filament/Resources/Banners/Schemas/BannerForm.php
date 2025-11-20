<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('subtitulo'),
                TextInput::make('imagen')
                    ->required(),
                TextInput::make('texto_boton'),
                TextInput::make('url_boton'),
                Select::make('tipo')
                    ->options(['hero' => 'Hero', 'secundario' => 'Secundario', 'promocion' => 'Promocion'])
                    ->required(),
                Toggle::make('activo')
                    ->required(),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
