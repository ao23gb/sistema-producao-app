<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoAlmoxarifado extends Model
{
    protected $table = 'movimentacoes_almoxarifado';

    protected $fillable = [
        'colaborador_id',
        'insumo_id',
        'material_id',
        'quantidade',
        'tipo_movimentacao',
        'observacao',
        'usuario_id',
    ];

    protected $casts = [
        'quantidade' => 'decimal:3',
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

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
