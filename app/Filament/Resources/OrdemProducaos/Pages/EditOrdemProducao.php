<?php

namespace App\Filament\Resources\OrdemProducaos\Pages;

use App\Filament\Resources\OrdemProducaos\OrdemProducaoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrdemProducao extends EditRecord
{
    protected static string $resource = OrdemProducaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
