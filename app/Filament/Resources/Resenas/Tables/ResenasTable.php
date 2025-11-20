<?php

namespace App\Filament\Resources\Resenas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResenasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('producto.id')
                    ->searchable(),
                TextColumn::make('nombre_cliente')
                    ->searchable(),
                TextColumn::make('email_cliente')
                    ->searchable(),
                TextColumn::make('calificacion')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('aprobado')
                    ->boolean(),
                IconColumn::make('destacado')
                    ->boolean(),
                TextColumn::make('timestamp_publicacion')
                    ->dateTime()
                    ->sortable(),
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
