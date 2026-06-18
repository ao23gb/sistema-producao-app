<?php

namespace App\Filament\Resources\PerfilAcessos\Pages;

use App\Filament\Resources\PerfilAcessos\PerfilAcessoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerfilAcesso extends EditRecord
{
    protected static string $resource = PerfilAcessoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
