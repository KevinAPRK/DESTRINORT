<?php

namespace App\Filament\Resources\Resenas;

use App\Filament\Resources\Resenas\Pages\CreateResena;
use App\Filament\Resources\Resenas\Pages\EditResena;
use App\Filament\Resources\Resenas\Pages\ListResenas;
use App\Filament\Resources\Resenas\Pages\ViewResena;
use App\Filament\Resources\Resenas\Schemas\ResenaForm;
use App\Filament\Resources\Resenas\Schemas\ResenaInfolist;
use App\Filament\Resources\Resenas\Tables\ResenasTable;
use App\Models\Resena;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResenaResource extends Resource
{
    protected static ?string $model = Resena::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre_cliente';

    protected static ?string $navigationLabel = 'Reseñas';

    protected static ?string $modelLabel = 'Reseña';

    protected static ?string $pluralModelLabel = 'Reseñas';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ResenaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ResenaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResenasTable::configure($table);
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
            'index' => ListResenas::route('/'),
            'create' => CreateResena::route('/create'),
            'view' => ViewResena::route('/{record}'),
            'edit' => EditResena::route('/{record}/edit'),
        ];
    }
}
