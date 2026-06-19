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
}
