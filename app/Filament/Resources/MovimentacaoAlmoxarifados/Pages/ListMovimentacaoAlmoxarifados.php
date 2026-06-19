<?php

namespace App\Filament\Resources\MovimentacaoAlmoxarifados\Pages;

use App\Filament\Resources\MovimentacaoAlmoxarifados\MovimentacaoAlmoxarifadoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMovimentacaoAlmoxarifados extends ListRecords
{
    protected static string $resource = MovimentacaoAlmoxarifadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
