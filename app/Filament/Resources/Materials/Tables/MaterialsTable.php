<?php

namespace App\Filament\Resources\Materials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaterialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipo_material')
                    ->label('Tipo')
                    ->sortable(),
                TextColumn::make('espessura_mm')
                    ->label('Espessura (mm)'),
                TextColumn::make('cor')
                    ->label('Cor')
                    ->searchable(),
                TextColumn::make('valor_custo')
                    ->label('Custo')
                    ->money('BRL')
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
