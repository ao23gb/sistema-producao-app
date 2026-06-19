<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
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

    public function componentes()
    {
        return $this->belongsToMany(Produto::class, 'produto_componentes', 'produto_principal_id', 'produto_componente_id')
            ->withPivot('quantidade')
            ->withTimestamps();
    }

    public function produtosPrincipais()
    {
        return $this->belongsToMany(Produto::class, 'produto_componentes', 'produto_componente_id', 'produto_principal_id')
            ->withPivot('quantidade')
            ->withTimestamps();
    }

    public function recalcularCusto(): void
    {
        if ($this->tipo === 'principal') {
            $custoComponentes = $this->componentes()->get()->sum(
                fn ($componente) => $componente->custo_unitario * $componente->pivot->quantidade
            );

            $custoInsumos = $this->insumos()->get()->sum(
                fn ($insumo) => ($insumo->custo_unitario ?? 0) * $insumo->pivot->quantidade
            );

            $this->updateQuietly([
                'custo_unitario' => $custoComponentes + $custoInsumos,
                'custo_caixa' => null,
            ]);

            return;
        }

        $custoChapa = $this->materiais()->get()->sum(
            fn ($material) => $material->valor_custo * $material->pivot->quantidade
        );

        $this->updateQuietly([
            'custo_caixa' => $custoChapa,
            'custo_unitario' => $this->qtd_pecas_por_caixa > 0 ? $custoChapa / $this->qtd_pecas_por_caixa : 0,
        ]);
    }
}
