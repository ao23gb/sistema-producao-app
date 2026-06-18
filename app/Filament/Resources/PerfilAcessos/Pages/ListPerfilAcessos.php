<?php

namespace App\Filament\Resources\PerfilAcessos\Pages;

use App\Filament\Resources\PerfilAcessos\PerfilAcessoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerfilAcessos extends ListRecords
{
    protected static string $resource = PerfilAcessoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
