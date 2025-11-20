<?php

namespace App\Filament\Resources\Articulos;

use App\Filament\Resources\Articulos\Pages\CreateArticulo;
use App\Filament\Resources\Articulos\Pages\EditArticulo;
use App\Filament\Resources\Articulos\Pages\ListArticulos;
use App\Filament\Resources\Articulos\Pages\ViewArticulo;
use App\Filament\Resources\Articulos\Schemas\ArticuloForm;
use App\Filament\Resources\Articulos\Schemas\ArticuloInfolist;
use App\Filament\Resources\Articulos\Tables\ArticulosTable;
use App\Models\Articulo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArticuloResource extends Resource
{
    protected static ?string $model = Articulo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static ?string $navigationLabel = 'Artículos del Blog';

    protected static ?string $modelLabel = 'Artículo';

    protected static ?string $pluralModelLabel = 'Artículos';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ArticuloForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArticuloInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticulosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticulos::route('/'),
            'create' => CreateArticulo::route('/create'),
            'view' => ViewArticulo::route('/{record}'),
            'edit' => EditArticulo::route('/{record}/edit'),
        ];
    }
}
