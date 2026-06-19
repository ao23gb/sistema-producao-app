<?php

namespace App\Filament\Resources\Insumos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InsumosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('codigo_id')
                    ->label('Código ID')
                    ->searchable(),
                TextColumn::make('codigo_interno')
                    ->label('Código Interno')
                    ->searchable(),
                TextColumn::make('codigo_barras')
                    ->label('Código de Barras')
                    ->searchable(),
                TextColumn::make('produto_unico')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn ($state) => $state ? 'info' : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? 'Avulso' : 'Caixa'),
                TextColumn::make('unidade_medida')
                    ->label('Unidade de Medida')
                    ->searchable(),
                TextColumn::make('qtd_por_caixa')
                    ->label('Peças/Caixa')
                    ->formatStateUsing(fn ($state, $record) => $record->produto_unico ? '—' : $state)
                    ->sortable(),
                TextColumn::make('custo_unitario')
                    ->label('Custo Unitário')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('custo_caixa')
                    ->label('Custo Caixa')
                    ->formatStateUsing(fn ($state, $record) => $record->produto_unico ? '—' : 'R$ ' . number_format($state ?? 0, 2, ',', '.'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
