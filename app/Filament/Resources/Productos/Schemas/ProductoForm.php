<?php

namespace App\Filament\Resources\Productos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('descripcion_corta')
                    ->columnSpanFull(),
                Textarea::make('descripcion_larga')
                    ->columnSpanFull(),
                TextInput::make('precio')
                    ->required()
                    ->numeric(),
                TextInput::make('precio_oferta')
                    ->numeric(),
                Select::make('marca_id')
                    ->relationship('marca', 'id')
                    ->required(),
                Select::make('categoria_id')
                    ->relationship('categoria', 'id')
                    ->required(),
                TextInput::make('imagen_principal'),
                TextInput::make('presentacion'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('disponible')
                    ->required(),
                Toggle::make('destacado')
                    ->required(),
                Toggle::make('activo')
                    ->required(),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('vistas')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('seo_titulo'),
                TextInput::make('seo_descripcion'),
            ]);
    }
}
