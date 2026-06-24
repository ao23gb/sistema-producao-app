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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['tipo_item'] = $this->record->insumo_id ? 'insumo' : 'material';

        $insumo = $this->record->insumo;

        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($data['quantidade_atribuida'] ?? null)) {
            $data['quantidade_atribuida_caixas'] = round($data['quantidade_atribuida'] / $insumo->qtd_por_caixa, 3);
        }

        return $data;
    }
}
