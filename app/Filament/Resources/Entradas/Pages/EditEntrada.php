<?php

namespace App\Filament\Resources\Entradas\Pages;

use App\Filament\Resources\Entradas\EntradaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEntrada extends EditRecord
{
    protected static string $resource = EntradaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $insumo = $this->record->insumo;

        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa) {
            if (filled($data['quantidade_pedida'] ?? null)) {
                $data['quantidade_pedida_caixas'] = round($data['quantidade_pedida'] / $insumo->qtd_por_caixa, 3);
            }

            if (filled($data['quantidade_recebida'] ?? null)) {
                $data['quantidade_recebida_caixas'] = round($data['quantidade_recebida'] / $insumo->qtd_por_caixa, 3);
            }
        }

        return $data;
    }
}
