<?php

namespace App\Filament\Resources\MovimentacaoAlmoxarifados;

use App\Filament\Resources\MovimentacaoAlmoxarifados\Pages\CreateMovimentacaoAlmoxarifado;
use App\Filament\Resources\MovimentacaoAlmoxarifados\Pages\EditMovimentacaoAlmoxarifado;
use App\Filament\Resources\MovimentacaoAlmoxarifados\Pages\ListMovimentacaoAlmoxarifados;
use App\Filament\Resources\MovimentacaoAlmoxarifados\Schemas\MovimentacaoAlmoxarifadoForm;
use App\Filament\Resources\MovimentacaoAlmoxarifados\Tables\MovimentacaoAlmoxarifadosTable;
use App\Models\MovimentacaoAlmoxarifado;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MovimentacaoAlmoxarifadoResource extends Resource
{
    protected static ?string $model = MovimentacaoAlmoxarifado::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MovimentacaoAlmoxarifadoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MovimentacaoAlmoxarifadosTable::configure($table);
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
            'index' => ListMovimentacaoAlmoxarifados::route('/'),
            'create' => CreateMovimentacaoAlmoxarifado::route('/create'),
            'edit' => EditMovimentacaoAlmoxarifado::route('/{record}/edit'),
        ];
    }
}
