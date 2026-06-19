<?php

namespace App\Filament\Resources\MaterialEmUsos\Pages;

use App\Filament\Resources\MaterialEmUsos\MaterialEmUsoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMaterialEmUso extends EditRecord
{
    protected static string $resource = MaterialEmUsoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
