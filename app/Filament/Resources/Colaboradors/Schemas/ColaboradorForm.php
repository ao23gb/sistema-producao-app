<?php

namespace App\Filament\Resources\Colaboradors\Schemas;

use App\Models\PerfilAcesso;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ColaboradorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('login')
                    ->label('Login')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('senha_hash')
                    ->label('Senha')
                    ->password()
                    ->required(fn ($record) => $record === null)
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255),
                Select::make('perfil_id')
                    ->label('Perfil de Acesso')
                    ->options(PerfilAcesso::pluck('nome_perfil', 'id'))
                    ->required(),
                Toggle::make('restringir_estoque')
                    ->label('Restringir acesso ao estoque'),
            ]);
    }
}
