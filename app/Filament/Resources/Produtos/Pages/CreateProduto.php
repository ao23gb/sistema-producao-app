<?php

namespace App\Filament\Resources\Produtos\Pages;

use App\Filament\Resources\Produtos\ProdutoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduto extends CreateRecord
{
    protected static string $resource = ProdutoResource::class;

    protected array $materiaisSelecionados = [];

    protected array $insumosSelecionados = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->materiaisSelecionados = $data['materiaisSelecionados'] ?? [];
        $this->insumosSelecionados = $data['insumosSelecionados'] ?? [];

        unset($data['materiaisSelecionados'], $data['insumosSelecionados']);

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->materiaisSelecionados as $item) {
            $this->record->materiais()->attach($item['material_id'], ['quantidade' => $item['quantidade']]);
        }

        foreach ($this->insumosSelecionados as $item) {
            $this->record->insumos()->attach($item['insumo_id'], ['quantidade' => $item['quantidade']]);
        }
    }
}
