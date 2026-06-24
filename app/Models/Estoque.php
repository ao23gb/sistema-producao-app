<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';

    protected $fillable = [
        'insumo_id',
        'material_id',
        'estoque_total',
        'aguardando_entrega',
        'atualizado_em',
    ];

    protected $casts = [
        'estoque_total' => 'decimal:3',
        'aguardando_entrega' => 'decimal:3',
        'atualizado_em' => 'datetime',
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function getEmUsoAttribute()
    {
        return MaterialEmUso::query()
            ->where('status', 'em_uso')
            ->when($this->insumo_id, fn ($query) => $query->where('insumo_id', $this->insumo_id))
            ->when($this->material_id, fn ($query) => $query->where('material_id', $this->material_id))
            ->sum('quantidade_atribuida');
    }

    public function getQuantidadeUnitariaAttribute()
    {
        return $this->estoque_total - $this->em_uso;
    }

    public function getQuantidadeCaixasAttribute()
    {
        if ($this->insumo && ! $this->insumo->produto_unico && $this->insumo->qtd_por_caixa) {
            return round(($this->estoque_total - $this->em_uso) / $this->insumo->qtd_por_caixa, 2);
        }

        return null;
    }

    public function getEhPorCaixaAttribute(): bool
    {
        return $this->insumo && ! $this->insumo->produto_unico;
    }

    public function getNomeProdutoAttribute(): ?string
    {
        return $this->insumo?->nome ?? $this->material?->nome;
    }

    public function getTipoProdutoAttribute(): string
    {
        return $this->insumo_id ? 'Insumo' : 'Material';
    }
}
