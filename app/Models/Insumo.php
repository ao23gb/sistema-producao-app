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
    ];

    protected $casts = [
        'produto_unico' => 'boolean',
    ];
}
