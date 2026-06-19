<?php

namespace App\Filament\Resources\MovimentacaoAlmoxarifados\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MovimentacaoAlmoxarifadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('colaborador.nome')
                    ->label('Colaborador')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipo_movimentacao')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'saida' => 'danger',
                        'ajuste' => 'warning',
                        'devolucao' => 'success',
                    }),
                TextColumn::make('insumo.nome')
                    ->label('Insumo')
                    ->searchable(),
                TextColumn::make('material.nome')
                    ->label('Material')
                    ->searchable(),
                TextColumn::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
