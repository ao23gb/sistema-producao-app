<?php

namespace App\Filament\Resources\MaterialEmUsos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaterialEmUsosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('colaborador.nome')
                    ->label('Colaborador')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('insumo.nome')
                    ->label('Insumo')
                    ->searchable(),
                TextColumn::make('material.nome')
                    ->label('Material')
                    ->searchable(),
                TextColumn::make('quantidade_atribuida')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => $state === 'em_uso' ? 'warning' : 'success'),
                TextColumn::make('atribuido_em')
                    ->label('Atribuído em')
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
