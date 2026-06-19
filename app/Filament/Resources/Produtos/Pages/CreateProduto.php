<?php

namespace App\Filament\Resources\Produtos\Pages;

use App\Filament\Resources\Produtos\ProdutoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduto extends CreateRecord
{
    protected static string $resource = ProdutoResource::class;

    protected array $materiaisSelecionados = [];

    protected array $insumosSelecionados = [];

    protected array $componentesSelecionados = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->materiaisSelecionados = $data['materiaisSelecionados'] ?? [];
        $this->insumosSelecionados = $data['insumosSelecionados'] ?? [];
        $this->componentesSelecionados = $data['componentesSelecionados'] ?? [];

        unset($data['materiaisSelecionados'], $data['insumosSelecionados'], $data['componentesSelecionados']);

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

        foreach ($this->componentesSelecionados as $item) {
            $this->record->componentes()->attach($item['produto_componente_id'], ['quantidade' => $item['quantidade']]);
        }

        $this->record->recalcularCusto();
    }
}
