<?php

namespace App\Filament\Resources\Configuracions;

use App\Filament\Resources\Configuracions\Pages\CreateConfiguracion;
use App\Filament\Resources\Configuracions\Pages\EditConfiguracion;
use App\Filament\Resources\Configuracions\Pages\ListConfiguracions;
use App\Filament\Resources\Configuracions\Pages\ViewConfiguracion;
use App\Filament\Resources\Configuracions\Schemas\ConfiguracionForm;
use App\Filament\Resources\Configuracions\Schemas\ConfiguracionInfolist;
use App\Filament\Resources\Configuracions\Tables\ConfiguracionsTable;
use App\Models\Configuracion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConfiguracionResource extends Resource
{
    protected static ?string $model = Configuracion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'clave';

    protected static ?string $navigationLabel = 'Configuraciones';

    protected static ?string $modelLabel = 'Configuración';

    protected static ?string $pluralModelLabel = 'Configuraciones';

    protected static ?string $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ConfiguracionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConfiguracionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConfiguracionsTable::configure($table);
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
            'index' => ListConfiguracions::route('/'),
            'create' => CreateConfiguracion::route('/create'),
            'view' => ViewConfiguracion::route('/{record}'),
            'edit' => EditConfiguracion::route('/{record}/edit'),
        ];
    }
}
