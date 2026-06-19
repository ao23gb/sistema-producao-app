<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $fillable = [
        'nome',
        'codigo_id',
        'codigo_interno',
        'codigo_barras',
        'produto_unico',
        'unidade_medida',
        'qtd_por_caixa',
        'custo_unitario',
        'custo_caixa',
    ];

    protected $casts = [
        'produto_unico' => 'boolean',
        'custo_unitario' => 'decimal:2',
        'custo_caixa' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::created(function (Insumo $insumo) {
            Estoque::create(['insumo_id' => $insumo->id]);
        });
    }
}
