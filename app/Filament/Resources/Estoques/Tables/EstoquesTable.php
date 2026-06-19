<?php

namespace App\Filament\Resources\Estoques\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EstoquesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('insumo.nome')
                    ->label('Insumo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('material.nome')
                    ->label('Material')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estoque_total')
                    ->label('Estoque Total')
                    ->numeric()
                    ->sortable(),
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
                //
            ]);
    }
}
