<?php

namespace App\Filament\Resources\Productos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('slug'),
                TextEntry::make('descripcion_corta')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('descripcion_larga')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('precio')
                    ->numeric(),
                TextEntry::make('precio_oferta')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('marca.id')
                    ->label('Marca'),
                TextEntry::make('categoria.id')
                    ->label('Categoria'),
                TextEntry::make('imagen_principal')
                    ->placeholder('-'),
                TextEntry::make('presentacion')
                    ->placeholder('-'),
                TextEntry::make('stock')
                    ->numeric(),
                IconEntry::make('disponible')
                    ->boolean(),
                IconEntry::make('destacado')
                    ->boolean(),
                IconEntry::make('activo')
                    ->boolean(),
                TextEntry::make('orden')
                    ->numeric(),
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
