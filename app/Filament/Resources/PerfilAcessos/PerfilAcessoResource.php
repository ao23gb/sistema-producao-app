<?php

namespace App\Filament\Resources\PerfilAcessos;

use App\Filament\Resources\PerfilAcessos\Pages\CreatePerfilAcesso;
use App\Filament\Resources\PerfilAcessos\Pages\EditPerfilAcesso;
use App\Filament\Resources\PerfilAcessos\Pages\ListPerfilAcessos;
use App\Filament\Resources\PerfilAcessos\Schemas\PerfilAcessoForm;
use App\Filament\Resources\PerfilAcessos\Tables\PerfilAcessosTable;
use App\Models\PerfilAcesso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PerfilAcessoResource extends Resource
{
    protected static ?string $model = PerfilAcesso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nome_perfil';

    public static function form(Schema $schema): Schema
    {
        return PerfilAcessoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerfilAcessosTable::configure($table);
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
            'index' => ListPerfilAcessos::route('/'),
            'create' => CreatePerfilAcesso::route('/create'),
            'edit' => EditPerfilAcesso::route('/{record}/edit'),
        ];
    }
}
