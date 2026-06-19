<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Select::make('tipo')
                    ->label('Tipo de Produto')
                    ->options([
                        'principal' => 'Produto Principal',
                        'componente' => 'Produto de Composição',
                        'unico' => 'Produto Único',
                    ])
                    ->default('principal')
                    ->required()
                    ->live(),
                TextInput::make('qtd_pecas_por_caixa')
                    ->label('Peças por Chapa')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->visible(fn ($get) => in_array($get('tipo'), ['componente', 'unico'])),
                Repeater::make('componentesSelecionados')
                    ->label('Produtos que Compõem')
                    ->schema([
                        Select::make('produto_componente_id')
                            ->label('Produto')
                            ->options(fn ($record) => \App\Models\Produto::where('tipo', 'componente')
                                ->when($record, fn ($query) => $query->where('id', '!=', $record->id))
                                ->pluck('nome', 'id'))
                            ->required(),
                        TextInput::make('quantidade')
                            ->label('Quantidade')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])
                    ->columns(2)
                    ->visible(fn ($get) => $get('tipo') === 'principal'),
                Repeater::make('materiaisSelecionados')
                    ->label('Materiais')
                    ->schema([
                        Select::make('material_id')
                            ->label('Material')
                            ->options(\App\Models\Material::pluck('nome', 'id'))
                            ->required(),
                        TextInput::make('quantidade')
                            ->label('Quantidade')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])
                    ->columns(2)
                    ->visible(fn ($get) => in_array($get('tipo'), ['componente', 'unico'])),
                Repeater::make('insumosSelecionados')
                    ->label('Insumos')
                    ->schema([
                        Select::make('insumo_id')
                            ->label('Insumo')
                            ->options(\App\Models\Insumo::pluck('nome', 'id'))
                            ->required(),
                        TextInput::make('quantidade')
                            ->label('Quantidade')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])
                    ->columns(2)
                    ->visible(fn ($get) => in_array($get('tipo'), ['componente', 'unico', 'principal'])),
            ]);
    }
}
