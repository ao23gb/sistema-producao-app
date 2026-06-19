<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'insumo_id',
        'fornecedor',
        'status',
        'quantidade_pedida',
        'quantidade_recebida',
        'usuario_id',
        'data_pedido',
        'data_confirmacao',
    ];

    protected $casts = [
        'quantidade_pedida' => 'decimal:3',
        'quantidade_recebida' => 'decimal:3',
        'data_pedido' => 'datetime',
        'data_confirmacao' => 'datetime',
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
