<?php

namespace App\Filament\Resources\EtapaKanbans\Pages;

use App\Filament\Resources\EtapaKanbans\EtapaKanbanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEtapaKanban extends EditRecord
{
    protected static string $resource = EtapaKanbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
