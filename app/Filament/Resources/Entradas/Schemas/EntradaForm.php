<?php

namespace App\Filament\Resources\Entradas\Schemas;

use App\Models\Insumo;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EntradaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('insumo_id')
                    ->label('Insumo')
                    ->options(Insumo::pluck('nome', 'id'))
                    ->required()
                    ->live(),
                TextInput::make('fornecedor')
                    ->label('Fornecedor')
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'aguardando_entrega' => 'Aguardando Entrega',
                        'confirmado' => 'Confirmado',
                    ])
                    ->default('aguardando_entrega')
                    ->required(),
                TextInput::make('quantidade_pedida_caixas')
                    ->label('Quantidade Pedida (Caixas)')
                    ->numeric()
                    ->dehydrated(false)
                    ->live(onBlur: true)
                    ->visible(function ($get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        return $insumo && ! $insumo->produto_unico;
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_pedida', round($state * $insumo->qtd_por_caixa, 3));
                        }
                    }),
                TextInput::make('quantidade_pedida')
                    ->label('Quantidade Pedida (Unidades)')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_pedida_caixas', round($state / $insumo->qtd_por_caixa, 3));
                        }
                    }),
                TextInput::make('quantidade_recebida_caixas')
                    ->label('Quantidade Recebida (Caixas)')
                    ->numeric()
                    ->dehydrated(false)
                    ->live(onBlur: true)
                    ->visible(function ($get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        return $insumo && ! $insumo->produto_unico;
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_recebida', round($state * $insumo->qtd_por_caixa, 3));
                        }
                    }),
                TextInput::make('quantidade_recebida')
                    ->label('Quantidade Recebida (Unidades)')
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $insumo = Insumo::find($get('insumo_id'));

                        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($state)) {
                            $set('quantidade_recebida_caixas', round($state / $insumo->qtd_por_caixa, 3));
                        }
                    }),
                DateTimePicker::make('data_pedido')
                    ->label('Data do Pedido'),
                DateTimePicker::make('data_confirmacao')
                    ->label('Data de Confirmação'),
            ]);
    }
}
