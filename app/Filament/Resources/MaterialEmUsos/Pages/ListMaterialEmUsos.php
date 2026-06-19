<?php

namespace App\Filament\Resources\MaterialEmUsos\Pages;

use App\Filament\Resources\MaterialEmUsos\MaterialEmUsoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMaterialEmUsos extends ListRecords
{
    protected static string $resource = MaterialEmUsoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
