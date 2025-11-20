<?php

namespace App\Filament\Resources\Articulos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticuloForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('extracto')
                    ->columnSpanFull(),
                Textarea::make('contenido')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('imagen_portada'),
                Select::make('autor_id')
                    ->relationship('autor', 'name')
                    ->required(),
                Toggle::make('publicado')
                    ->required(),
                DateTimePicker::make('fecha_publicacion'),
                TextInput::make('vistas')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('seo_titulo'),
                TextInput::make('seo_descripcion'),
            ]);
    }
}
