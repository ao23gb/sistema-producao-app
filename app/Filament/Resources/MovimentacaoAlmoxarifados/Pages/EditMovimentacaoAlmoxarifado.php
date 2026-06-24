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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['tipo_item'] = $this->record->insumo_id ? 'insumo' : 'material';

        $insumo = $this->record->insumo;

        if ($insumo && ! $insumo->produto_unico && $insumo->qtd_por_caixa && filled($data['quantidade'] ?? null)) {
            $data['quantidade_caixas'] = round($data['quantidade'] / $insumo->qtd_por_caixa, 3);
        }

        return $data;
    }
}
