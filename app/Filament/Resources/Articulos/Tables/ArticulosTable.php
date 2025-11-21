<?php

namespace App\Filament\Resources\Articulos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticulosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('imagen_portada')
                    ->label('Imagen Portada'),
                TextColumn::make('autor.name')
                    ->searchable(),
                IconColumn::make('publicado')
                    ->boolean(),
                TextColumn::make('fecha_publicacion')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('vistas')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('seo_titulo')
                    ->searchable(),
                TextColumn::make('seo_descripcion')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
