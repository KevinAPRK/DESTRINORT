<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FaqInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pregunta'),
                TextEntry::make('respuesta')
                    ->columnSpanFull(),
                TextEntry::make('categoria')
                    ->placeholder('-'),
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
