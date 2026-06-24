<?php

namespace App\Filament\Resources\OrdemProducaos\Schemas;

use App\Models\EtapaKanban;
use App\Models\Produto;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrdemProducaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->label('Produto')
                    ->options(Produto::pluck('nome', 'id'))
                    ->required()
                    ->live(),
                TextInput::make('quantidade_chapas')
                    ->label('Quantidade (Chapas)')
                    ->numeric()
                    ->dehydrated(false)
                    ->live(onBlur: true)
                    ->visible(function ($get) {
                        $produto = Produto::find($get('produto_id'));

                        return $produto && in_array($produto->tipo, ['componente', 'unico']) && $produto->qtd_pecas_por_caixa > 0;
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $produto = Produto::find($get('produto_id'));

                        if ($produto && $produto->qtd_pecas_por_caixa > 0 && filled($state)) {
                            $set('quantidade', round($state * $produto->qtd_pecas_por_caixa, 3));
                        }
                    }),
                TextInput::make('quantidade')
                    ->label('Quantidade (Unidades)')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $produto = Produto::find($get('produto_id'));

                        if ($produto && in_array($produto->tipo, ['componente', 'unico']) && $produto->qtd_pecas_por_caixa > 0 && filled($state)) {
                            $set('quantidade_chapas', round($state / $produto->qtd_pecas_por_caixa, 3));
                        }
                    }),
                Select::make('etapa_atual_id')
                    ->label('Etapa Atual')
                    ->options(EtapaKanban::orderBy('ordem')->pluck('nome_etapa', 'id'))
                    ->default(fn () => EtapaKanban::where('ativa', true)->orderBy('ordem')->first()?->id),
            ]);
    }
}
