<?php

namespace App\Filament\Resources\Resenas\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ResenaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('producto.id')
                    ->label('Producto')
                    ->placeholder('-'),
                TextEntry::make('nombre_cliente'),
                TextEntry::make('email_cliente')
                    ->placeholder('-'),
                TextEntry::make('calificacion')
                    ->numeric(),
                TextEntry::make('comentario')
                    ->columnSpanFull(),
                IconEntry::make('aprobado')
                    ->boolean(),
                IconEntry::make('destacado')
                    ->boolean(),
                TextEntry::make('timestamp_publicacion')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
