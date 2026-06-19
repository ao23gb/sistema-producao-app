<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'qtd_pecas_por_caixa',
        'custo_unitario',
        'custo_caixa',
    ];

    protected $casts = [
        'custo_unitario' => 'decimal:2',
        'custo_caixa' => 'decimal:2',
    ];

    public function materiais()
    {
        return $this->belongsToMany(Material::class, 'produto_materiais')
            ->withPivot('quantidade')
            ->withTimestamps();
    }

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'produto_insumos')
            ->withPivot('quantidade')
            ->withTimestamps();
    }

    public function recalcularCusto(): void
    {
        $custoChapa = $this->materiais()->get()->sum(
            fn ($material) => $material->valor_custo * $material->pivot->quantidade
        );

        $this->updateQuietly([
            'custo_caixa' => $custoChapa,
            'custo_unitario' => $this->qtd_pecas_por_caixa > 0 ? $custoChapa / $this->qtd_pecas_por_caixa : 0,
        ]);
    }
}
