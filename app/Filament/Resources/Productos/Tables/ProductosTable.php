<?php

namespace App\Filament\Resources\Productos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen_principal')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),
                TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('marca.nombre')
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('precio')
                    ->money('PEN')
                    ->sortable(),
                TextColumn::make('precio_oferta')
                    ->money('PEN')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('presentacion')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('disponible')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('destacado')
                    ->boolean()
                    ->label('★ Destacado')
                    ->toggleable(),
                IconColumn::make('activo')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('vistas')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
