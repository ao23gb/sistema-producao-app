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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $produto = $this->record->produto;

        if ($produto && in_array($produto->tipo, ['componente', 'unico']) && $produto->qtd_pecas_por_caixa > 0 && filled($data['quantidade'] ?? null)) {
            $data['quantidade_chapas'] = round($data['quantidade'] / $produto->qtd_pecas_por_caixa, 3);
        }

        return $data;
    }
}
