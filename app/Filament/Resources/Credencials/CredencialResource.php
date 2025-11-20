<?php

namespace App\Filament\Resources\Credencials;

use App\Filament\Resources\Credencials\Pages\CreateCredencial;
use App\Filament\Resources\Credencials\Pages\EditCredencial;
use App\Filament\Resources\Credencials\Pages\ListCredencials;
use App\Filament\Resources\Credencials\Pages\ViewCredencial;
use App\Filament\Resources\Credencials\Schemas\CredencialForm;
use App\Filament\Resources\Credencials\Schemas\CredencialInfolist;
use App\Filament\Resources\Credencials\Tables\CredencialsTable;
use App\Models\Credencial;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CredencialResource extends Resource
{
    protected static ?string $model = Credencial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    protected static ?string $navigationLabel = 'Credenciales';

    protected static ?string $modelLabel = 'Credencial';

    protected static ?string $pluralModelLabel = 'Credenciales';

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CredencialForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CredencialInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CredencialsTable::configure($table);
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
            'index' => ListCredencials::route('/'),
            'create' => CreateCredencial::route('/create'),
            'view' => ViewCredencial::route('/{record}'),
            'edit' => EditCredencial::route('/{record}/edit'),
        ];
    }
}
