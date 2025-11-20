<?php

namespace App\Filament\Resources\Configuracions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ConfiguracionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('clave'),
                TextEntry::make('valor')
                    ->columnSpanFull(),
                TextEntry::make('tipo')
                    ->badge(),
                TextEntry::make('grupo'),
                TextEntry::make('descripcion')
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
