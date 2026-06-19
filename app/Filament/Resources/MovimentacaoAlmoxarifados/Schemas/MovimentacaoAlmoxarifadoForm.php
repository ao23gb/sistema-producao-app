<?php

namespace App\Filament\Resources\MovimentacaoAlmoxarifados\Schemas;

use App\Models\Colaborador;
use App\Models\Insumo;
use App\Models\Material;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MovimentacaoAlmoxarifadoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('colaborador_id')
                    ->label('Colaborador')
                    ->options(Colaborador::pluck('nome', 'id'))
                    ->required(),
                Select::make('tipo_movimentacao')
                    ->label('Tipo')
                    ->options([
                        'saida' => 'Saída',
                        'ajuste' => 'Ajuste',
                        'devolucao' => 'Devolução',
                    ])
                    ->required(),
                Select::make('insumo_id')
                    ->label('Insumo')
                    ->options(Insumo::pluck('nome', 'id'))
                    ->nullable(),
                Select::make('material_id')
                    ->label('Material')
                    ->options(Material::pluck('nome', 'id'))
                    ->nullable(),
                TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->required(),
                Textarea::make('observacao')
                    ->label('Observação')
                    ->rows(3),
            ]);
    }
}
