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
                TextInput::make('quantidade_caixas')
                    ->label('Quantidade (Caixas)')
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
                            $set('quantidade', round($state * $insumo->qtd_por_caixa, 3));
                        }
                    }),
                TextInput::make('quantidade')
                    ->label('Quantidade (Unidades)')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($get('tipo_item') === 'insumo' && $insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_caixas', round($state / $insumo->qtd_por_caixa, 3));
                        }
                    }),
                Textarea::make('observacao')
                    ->label('Observação')
                    ->rows(3),
            ]);
    }
}
