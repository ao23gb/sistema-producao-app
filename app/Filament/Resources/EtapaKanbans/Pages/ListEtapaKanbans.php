<?php

namespace App\Filament\Resources\EtapaKanbans\Pages;

use App\Filament\Resources\EtapaKanbans\EtapaKanbanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEtapaKanbans extends ListRecords
{
    protected static string $resource = EtapaKanbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
