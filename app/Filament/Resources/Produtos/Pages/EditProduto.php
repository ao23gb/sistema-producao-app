<?php

namespace App\Filament\Resources\Produtos\Pages;

use App\Filament\Resources\Produtos\ProdutoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduto extends EditRecord
{
    protected static string $resource = ProdutoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['materiaisSelecionados'] = $this->record->materiais->map(fn ($material) => [
            'material_id' => $material->id,
            'quantidade' => $material->pivot->quantidade,
        ])->toArray();

        $data['insumosSelecionados'] = $this->record->insumos->map(fn ($insumo) => [
            'insumo_id' => $insumo->id,
            'quantidade' => $insumo->pivot->quantidade,
        ])->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->materiaisSelecionados = $data['materiaisSelecionados'] ?? [];
        $this->insumosSelecionados = $data['insumosSelecionados'] ?? [];

        unset($data['materiaisSelecionados'], $data['insumosSelecionados']);

        return $data;
    }

    protected array $materiaisSelecionados = [];

    protected array $insumosSelecionados = [];

    protected function afterSave(): void
    {
        $this->record->materiais()->sync(
            collect($this->materiaisSelecionados)->mapWithKeys(fn ($item) => [$item['material_id'] => ['quantidade' => $item['quantidade']]])
        );

        $this->record->insumos()->sync(
            collect($this->insumosSelecionados)->mapWithKeys(fn ($item) => [$item['insumo_id'] => ['quantidade' => $item['quantidade']]])
        );
    }
}
