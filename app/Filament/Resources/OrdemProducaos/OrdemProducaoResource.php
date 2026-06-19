<?php

namespace App\Filament\Resources\OrdemProducaos;

use App\Filament\Resources\OrdemProducaos\Pages\CreateOrdemProducao;
use App\Filament\Resources\OrdemProducaos\Pages\EditOrdemProducao;
use App\Filament\Resources\OrdemProducaos\Pages\ListOrdemProducaos;
use App\Filament\Resources\OrdemProducaos\Schemas\OrdemProducaoForm;
use App\Filament\Resources\OrdemProducaos\Tables\OrdemProducaosTable;
use App\Models\OrdemProducao;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrdemProducaoResource extends Resource
{
    protected static ?string $model = OrdemProducao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return OrdemProducaoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdemProducaosTable::configure($table);
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
            'index' => ListOrdemProducaos::route('/'),
            'create' => CreateOrdemProducao::route('/create'),
            'edit' => EditOrdemProducao::route('/{record}/edit'),
        ];
    }
}
