<?php

namespace App\Filament\Resources\PerfilAcessos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PerfilAcessosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome_perfil')
                    ->label('Perfil')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('pode_cadastrar')
                    ->label('Cadastrar')
                    ->boolean(),
                IconColumn::make('pode_movimentar_estoque')
                    ->label('Estoque')
                    ->boolean(),
                IconColumn::make('pode_gerenciar_kanban')
                    ->label('Kanban')
                    ->boolean(),
                IconColumn::make('pode_visualizar_relatorios')
                    ->label('Relatórios')
                    ->boolean(),
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
