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

        $data['componentesSelecionados'] = $this->record->componentes->map(fn ($componente) => [
            'produto_componente_id' => $componente->id,
            'quantidade' => $componente->pivot->quantidade,
        ])->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->materiaisSelecionados = $data['materiaisSelecionados'] ?? [];
        $this->insumosSelecionados = $data['insumosSelecionados'] ?? [];
        $this->componentesSelecionados = $data['componentesSelecionados'] ?? [];

        unset($data['materiaisSelecionados'], $data['insumosSelecionados'], $data['componentesSelecionados']);

        return $data;
    }

    protected array $materiaisSelecionados = [];

    protected array $insumosSelecionados = [];

    protected array $componentesSelecionados = [];

    protected function afterSave(): void
    {
        $this->record->materiais()->sync(
            collect($this->materiaisSelecionados)->mapWithKeys(fn ($item) => [$item['material_id'] => ['quantidade' => $item['quantidade']]])
        );

        $this->record->insumos()->sync(
            collect($this->insumosSelecionados)->mapWithKeys(fn ($item) => [$item['insumo_id'] => ['quantidade' => $item['quantidade']]])
        );

        $this->record->componentes()->sync(
            collect($this->componentesSelecionados)->mapWithKeys(fn ($item) => [$item['produto_componente_id'] => ['quantidade' => $item['quantidade']]])
        );

        $this->record->recalcularCusto();
    }
}
