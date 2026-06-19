<?php

namespace App\Filament\Resources\MovimentacaoAlmoxarifados\Pages;

use App\Filament\Resources\MovimentacaoAlmoxarifados\MovimentacaoAlmoxarifadoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMovimentacaoAlmoxarifado extends EditRecord
{
    protected static string $resource = MovimentacaoAlmoxarifadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
