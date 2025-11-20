<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BannerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulo'),
                TextEntry::make('subtitulo')
                    ->placeholder('-'),
                TextEntry::make('imagen'),
                TextEntry::make('texto_boton')
                    ->placeholder('-'),
                TextEntry::make('url_boton')
                    ->placeholder('-'),
                TextEntry::make('tipo')
                    ->badge(),
                IconEntry::make('activo')
                    ->boolean(),
                TextEntry::make('orden')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
