<?php

namespace App\Filament\Resources\Productos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('precio')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('precio_oferta')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('marca.id')
                    ->searchable(),
                TextColumn::make('categoria.id')
                    ->searchable(),
                TextColumn::make('imagen_principal')
                    ->searchable(),
                TextColumn::make('presentacion')
                    ->searchable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('disponible')
                    ->boolean(),
                IconColumn::make('destacado')
                    ->boolean(),
                IconColumn::make('activo')
                    ->boolean(),
                TextColumn::make('orden')
                    ->numeric()
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
