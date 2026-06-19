<?php

namespace App\Filament\Resources\OrdemProducaos\Schemas;

use App\Models\EtapaKanban;
use App\Models\Produto;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrdemProducaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->label('Produto')
                    ->options(Produto::pluck('nome', 'id'))
                    ->required(),
                TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->required()
                    ->numeric(),
                Select::make('etapa_atual_id')
                    ->label('Etapa Atual')
                    ->options(EtapaKanban::orderBy('ordem')->pluck('nome_etapa', 'id'))
                    ->default(fn () => EtapaKanban::where('ativa', true)->orderBy('ordem')->first()?->id),
            ]);
    }
}
