<?php

namespace App\Filament\Resources\EtapaKanbans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EtapaKanbanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome_etapa')
                    ->label('Nome da Etapa')
                    ->required()
                    ->maxLength(255),
                TextInput::make('ordem')
                    ->label('Ordem')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Toggle::make('ativa')
                    ->label('Ativa')
                    ->default(true),
            ]);
    }
}
