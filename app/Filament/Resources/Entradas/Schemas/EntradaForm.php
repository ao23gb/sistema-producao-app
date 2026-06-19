<?php

namespace App\Filament\Resources\Entradas\Schemas;

use App\Models\Insumo;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EntradaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('insumo_id')
                    ->label('Insumo')
                    ->options(Insumo::pluck('nome', 'id'))
                    ->required(),
                TextInput::make('fornecedor')
                    ->label('Fornecedor')
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'aguardando_entrega' => 'Aguardando Entrega',
                        'confirmado' => 'Confirmado',
                    ])
                    ->default('aguardando_entrega')
                    ->required(),
                TextInput::make('quantidade_pedida')
                    ->label('Quantidade Pedida')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('quantidade_recebida')
                    ->label('Quantidade Recebida')
                    ->numeric(),
                DateTimePicker::make('data_pedido')
                    ->label('Data do Pedido'),
                DateTimePicker::make('data_confirmacao')
                    ->label('Data de Confirmação'),
            ]);
    }
}
