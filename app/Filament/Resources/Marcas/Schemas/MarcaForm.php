<?php

namespace App\Filament\Resources\Marcas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MarcaForm
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
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('marcas/logos')
                    ->imageEditor()
                    ->maxSize(2048),
                Toggle::make('activo')
                    ->required(),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
