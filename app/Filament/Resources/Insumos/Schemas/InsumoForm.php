<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                Select::make('produto_unico')
                    ->label('Tipo de Embalagem')
                    ->options([
                        1 => 'Avulso (Único)',
                        0 => 'Caixa',
                    ])
                    ->default(1)
                    ->required()
                    ->live(),
                TextInput::make('unidade_medida')
                    ->label('Unidade de Medida')
                    ->maxLength(255),
                TextInput::make('qtd_por_caixa')
                    ->label('Peças por Caixa')
                    ->numeric()
                    ->required()
                    ->live()
                    ->visible(fn ($get) => ! $get('produto_unico')),
                TextInput::make('custo_unitario')
                    ->label('Custo Unitário')
                    ->numeric()
                    ->prefix('R$')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $qtdPorCaixa = $get('qtd_por_caixa');

                        if (filled($state) && $qtdPorCaixa > 0 && ! $get('produto_unico')) {
                            $set('custo_caixa', round($state * $qtdPorCaixa, 2));
                        }
                    }),
                TextInput::make('custo_caixa')
                    ->label('Custo Caixa')
                    ->numeric()
                    ->prefix('R$')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $qtdPorCaixa = $get('qtd_por_caixa');

                        if (filled($state) && $qtdPorCaixa > 0) {
                            $set('custo_unitario', round($state / $qtdPorCaixa, 2));
                        }
                    })
                    ->visible(fn ($get) => ! $get('produto_unico')),
            ]);
    }
}
