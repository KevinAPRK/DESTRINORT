<?php

namespace App\Filament\Resources\Categorias\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                FileUpload::make('imagen')
                    ->image()
                    ->disk('public')
                    ->directory('categorias/imagenes')
                    ->imageEditor()
                    ->maxSize(2048),
                FileUpload::make('icono')
                    ->image()
                    ->disk('public')
                    ->directory('categorias/iconos')
                    ->imageEditor()
                    ->maxSize(1024),
                Toggle::make('activo')
                    ->required(),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
