<?php

namespace App\Filament\Resources\EtapaKanbans;

use App\Filament\Resources\EtapaKanbans\Pages\CreateEtapaKanban;
use App\Filament\Resources\EtapaKanbans\Pages\EditEtapaKanban;
use App\Filament\Resources\EtapaKanbans\Pages\ListEtapaKanbans;
use App\Filament\Resources\EtapaKanbans\Schemas\EtapaKanbanForm;
use App\Filament\Resources\EtapaKanbans\Tables\EtapaKanbansTable;
use App\Models\EtapaKanban;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EtapaKanbanResource extends Resource
{
    protected static ?string $model = EtapaKanban::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nome_etapa';

    public static function form(Schema $schema): Schema
    {
        return EtapaKanbanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EtapaKanbansTable::configure($table);
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
            'index' => ListEtapaKanbans::route('/'),
            'create' => CreateEtapaKanban::route('/create'),
            'edit' => EditEtapaKanban::route('/{record}/edit'),
        ];
    }
}
