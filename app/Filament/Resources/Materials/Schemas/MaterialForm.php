<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialForm
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
                Select::make('tipo_material')
                    ->label('Tipo')
                    ->options(['MDF' => 'MDF', 'MDP' => 'MDP']),
                TextInput::make('espessura_mm')
                    ->label('Espessura (mm)')
                    ->numeric(),
                TextInput::make('cor')
                    ->label('Cor')
                    ->maxLength(255),
                TextInput::make('valor_custo')
                    ->label('Valor de Custo')
                    ->numeric()
                    ->prefix('R$'),
            ]);
    }
}
