<?php

namespace App\Filament\Resources\Resenas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResenaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('producto_id')
                    ->relationship('producto', 'id'),
                TextInput::make('nombre_cliente')
                    ->required(),
                TextInput::make('email_cliente')
                    ->email(),
                TextInput::make('calificacion')
                    ->required()
                    ->numeric(),
                Textarea::make('comentario')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('aprobado')
                    ->required(),
                Toggle::make('destacado')
                    ->required(),
                DateTimePicker::make('timestamp_publicacion'),
            ]);
    }
}
