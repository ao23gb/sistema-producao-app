<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialEmUso extends Model
{
    protected $table = 'materiais_em_uso';

    protected $fillable = [
        'colaborador_id',
        'insumo_id',
        'material_id',
        'quantidade_atribuida',
        'status',
        'observacao_baixa',
        'atribuido_em',
        'baixado_em',
    ];

    protected $casts = [
        'quantidade_atribuida' => 'decimal:3',
        'atribuido_em' => 'datetime',
        'baixado_em' => 'datetime',
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
