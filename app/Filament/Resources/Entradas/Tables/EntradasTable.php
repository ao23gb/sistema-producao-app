<?php

namespace App\Filament\Resources\Entradas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EntradasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('insumo.nome')
                    ->label('Insumo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fornecedor')
                    ->label('Fornecedor')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'aguardando_entrega' => 'warning',
                        'confirmado' => 'success',
                    }),
                TextColumn::make('quantidade_pedida')
                    ->label('Qtd. Pedida')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quantidade_recebida')
                    ->label('Qtd. Recebida')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('data_pedido')
                    ->label('Data Pedido')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                TextColumn::make('data_confirmacao')
                    ->label('Data Confirmação')
                    ->dateTime('d/m/Y')
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
