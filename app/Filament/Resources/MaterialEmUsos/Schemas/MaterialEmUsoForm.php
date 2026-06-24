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
                Select::make('tipo_item')
                    ->label('Tipo de Item')
                    ->options([
                        'insumo' => 'Insumo',
                        'material' => 'Material',
                    ])
                    ->default('insumo')
                    ->required()
                    ->dehydrated(false)
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('insumo_id', null);
                        $set('material_id', null);
                    }),
                Select::make('insumo_id')
                    ->label('Insumo')
                    ->options(Insumo::pluck('nome', 'id'))
                    ->required()
                    ->live()
                    ->visible(fn ($get) => $get('tipo_item') === 'insumo'),
                Select::make('material_id')
                    ->label('Material')
                    ->options(Material::pluck('nome', 'id'))
                    ->required()
                    ->visible(fn ($get) => $get('tipo_item') === 'material'),
                TextInput::make('quantidade_atribuida_caixas')
                    ->label('Quantidade Atribuída (Caixas)')
                    ->numeric()
                    ->dehydrated(false)
                    ->live(onBlur: true)
                    ->visible(function ($get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        return $get('tipo_item') === 'insumo' && $insumo && ! $insumo->produto_unico;
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_atribuida', round($state * $insumo->qtd_por_caixa, 3));
                        }
                    }),
                TextInput::make('quantidade_atribuida')
                    ->label('Quantidade Atribuída (Unidades)')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($get('tipo_item') === 'insumo' && $insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_atribuida_caixas', round($state / $insumo->qtd_por_caixa, 3));
                        }
                    }),
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
