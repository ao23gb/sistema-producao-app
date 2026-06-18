<?php

namespace App\Filament\Resources\EtapaKanbans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EtapaKanbansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome_etapa')
                    ->label('Etapa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ordem')
                    ->label('Ordem')
                    ->sortable(),
                IconColumn::make('ativa')
                    ->label('Ativa')
                    ->boolean(),
            ])
            ->defaultSort('ordem')
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
