<?php

namespace App\Filament\Resources\Produtos\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProdutosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query
                    ->select('produtos.*')
                    ->selectSub(function ($sub) {
                        $sub->from('produto_componentes')
                            ->select('produto_principal_id')
                            ->whereColumn('produto_componente_id', 'produtos.id')
                            ->limit(1);
                    }, 'grupo_principal_id')
                    ->orderByRaw('COALESCE(grupo_principal_id, produtos.id) asc')
                    ->orderByRaw("CASE WHEN tipo = 'principal' THEN 0 ELSE 1 END asc")
                    ->orderBy('nome');
            })
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'principal' => 'success',
                        'componente' => 'gray',
                        'unico' => 'info',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'principal' => 'Principal',
                        'componente' => 'Composição',
                        'unico' => 'Único',
                    })
                    ->sortable(),
                TextColumn::make('qtd_pecas_por_caixa')
                    ->label('Peças/Chapa')
                    ->formatStateUsing(fn ($state, $record) => $record->tipo === 'principal' ? '—' : $state)
                    ->sortable(),
                TextColumn::make('custo_unitario')
                    ->label('Custo Unitário')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('custo_caixa')
                    ->label('Custo Chapa')
                    ->formatStateUsing(fn ($state, $record) => $record->tipo === 'principal' ? '—' : 'R$ ' . number_format($state ?? 0, 2, ',', '.'))
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->label('Tipo')
                    ->multiple()
                    ->options([
                        'principal' => 'Principal',
                        'componente' => 'Composição',
                        'unico' => 'Único',
                    ]),
            ])
            ->recordActions([
                Action::make('verComposicao')
                    ->label('Composição')
                    ->icon('heroicon-o-squares-2x2')
                    ->color('gray')
                    ->visible(fn ($record) => $record->tipo === 'principal' && $record->componentes()->count() > 0)
                    ->modalHeading(fn ($record) => "Composição de {$record->nome}")
                    ->modalContent(fn ($record) => view('filament.produtos.composicao', [
                        'componentes' => $record->componentes,
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Fechar'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
