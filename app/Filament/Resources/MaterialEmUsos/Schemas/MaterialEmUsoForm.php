<?php

namespace App\Filament\Resources\MaterialEmUsos\Schemas;

use App\Models\Colaborador;
use App\Models\Insumo;
use App\Models\Material;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialEmUsoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('colaborador_id')
                    ->label('Colaborador')
                    ->options(Colaborador::pluck('nome', 'id'))
                    ->required(),
                Select::make('insumo_id')
                    ->label('Insumo')
                    ->options(Insumo::pluck('nome', 'id')),
                Select::make('material_id')
                    ->label('Material')
                    ->options(Material::pluck('nome', 'id')),
                TextInput::make('quantidade_atribuida')
                    ->label('Quantidade Atribuída')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'em_uso' => 'Em Uso',
                        'baixado' => 'Baixado',
                    ])
                    ->default('em_uso')
                    ->required(),
                Textarea::make('observacao_baixa')
                    ->label('Observação da Baixa')
                    ->rows(3),
                DateTimePicker::make('atribuido_em')
                    ->label('Atribuído em')
                    ->default(now()),
                DateTimePicker::make('baixado_em')
                    ->label('Baixado em'),
            ]);
    }
}
