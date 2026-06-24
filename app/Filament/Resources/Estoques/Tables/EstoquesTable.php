<?php

namespace App\Filament\Resources\Estoques\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EstoquesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome_produto')
                    ->label('Produto')
                    ->searchable(query: function ($query, string $search) {
                        $query->where(function ($query) use ($search) {
                            $query->whereHas('insumo', fn ($q) => $q->where('nome', 'like', "%{$search}%"))
                                ->orWhereHas('material', fn ($q) => $q->where('nome', 'like', "%{$search}%"));
                        });
                    }),
                TextColumn::make('tipo_produto')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn ($state) => $state === 'Insumo' ? 'info' : 'warning'),
                TextColumn::make('em_uso')
                    ->label('Em Uso')
                    ->numeric(),
                TextColumn::make('quantidade_caixas')
                    ->label('Quantidade em Caixas')
                    ->formatStateUsing(fn ($state) => $state ?? '—'),
                TextColumn::make('quantidade_unitaria')
                    ->label('Quantidade Unitária')
                    ->numeric(),
                TextColumn::make('aguardando_entrega')
                    ->label('Aguardando Entrega')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('atualizado_em')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'insumo' => 'Insumo',
                        'material' => 'Material',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === 'insumo') {
                            $query->whereNotNull('insumo_id');
                        } elseif ($data['value'] === 'material') {
                            $query->whereNotNull('material_id');
                        }
                    }),
            ]);
    }
}
