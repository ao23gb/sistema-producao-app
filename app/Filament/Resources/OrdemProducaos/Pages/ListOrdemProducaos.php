<?php

namespace App\Filament\Resources\OrdemProducaos\Pages;

use App\Filament\Resources\OrdemProducaos\OrdemProducaoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrdemProducaos extends ListRecords
{
    protected static string $resource = OrdemProducaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
