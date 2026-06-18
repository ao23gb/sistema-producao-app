<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('codigo_id')
                    ->label('Código ID')
                    ->maxLength(255),
                TextInput::make('codigo_interno')
                    ->label('Código Interno')
                    ->maxLength(255),
                TextInput::make('codigo_barras')
                    ->label('Código de Barras')
                    ->maxLength(255),
                Toggle::make('produto_unico')
                    ->label('Produto Único'),
                TextInput::make('unidade_medida')
                    ->label('Unidade de Medida')
                    ->maxLength(255),
            ]);
    }
}
