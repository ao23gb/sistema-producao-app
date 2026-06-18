<?php

namespace App\Filament\Resources\PerfilAcessos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PerfilAcessoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome_perfil')
                    ->label('Nome do Perfil')
                    ->required()
                    ->maxLength(255),
                Toggle::make('pode_cadastrar')
                    ->label('Pode Cadastrar'),
                Toggle::make('pode_movimentar_estoque')
                    ->label('Pode Movimentar Estoque'),
                Toggle::make('pode_gerenciar_kanban')
                    ->label('Pode Gerenciar Kanban'),
                Toggle::make('pode_visualizar_relatorios')
                    ->label('Pode Visualizar Relatórios'),
            ]);
    }
}
