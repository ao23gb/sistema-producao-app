<?php

namespace App\Filament\Resources\MaterialEmUsos;

use App\Filament\Resources\MaterialEmUsos\Pages\CreateMaterialEmUso;
use App\Filament\Resources\MaterialEmUsos\Pages\EditMaterialEmUso;
use App\Filament\Resources\MaterialEmUsos\Pages\ListMaterialEmUsos;
use App\Filament\Resources\MaterialEmUsos\Schemas\MaterialEmUsoForm;
use App\Filament\Resources\MaterialEmUsos\Tables\MaterialEmUsosTable;
use App\Models\MaterialEmUso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MaterialEmUsoResource extends Resource
{
    protected static ?string $model = MaterialEmUso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MaterialEmUsoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterialEmUsosTable::configure($table);
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
            'index' => ListMaterialEmUsos::route('/'),
            'create' => CreateMaterialEmUso::route('/create'),
            'edit' => EditMaterialEmUso::route('/{record}/edit'),
        ];
    }
}
