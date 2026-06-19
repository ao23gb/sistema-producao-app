<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiais';

    protected $fillable = [
        'nome',
        'foto_url',
        'codigo_id',
        'codigo_interno',
        'codigo_barras',
        'tipo_material',
        'espessura_mm',
        'cor',
        'valor_custo',
    ];

    protected $casts = [
        'espessura_mm' => 'decimal:2',
        'valor_custo' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::created(function (Material $material) {
            Estoque::create(['material_id' => $material->id]);
        });
    }
}
