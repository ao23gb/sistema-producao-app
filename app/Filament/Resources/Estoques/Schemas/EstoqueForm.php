<?php

namespace App\Filament\Resources\Estoques\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EstoqueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('insumo_id')
                    ->numeric(),
                TextInput::make('material_id')
                    ->numeric(),
                TextInput::make('estoque_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('aguardando_entrega')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('atualizado_em'),
            ]);
    }
}
