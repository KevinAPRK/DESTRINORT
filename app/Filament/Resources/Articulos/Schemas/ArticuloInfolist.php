<?php

namespace App\Filament\Resources\Articulos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArticuloInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulo'),
                TextEntry::make('slug'),
                TextEntry::make('extracto')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('contenido')
                    ->columnSpanFull(),
                TextEntry::make('imagen_portada')
                    ->placeholder('-'),
                TextEntry::make('autor.name')
                    ->label('Autor'),
                IconEntry::make('publicado')
                    ->boolean(),
                TextEntry::make('fecha_publicacion')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('vistas')
                    ->numeric(),
                TextEntry::make('seo_titulo')
                    ->placeholder('-'),
                TextEntry::make('seo_descripcion')
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
