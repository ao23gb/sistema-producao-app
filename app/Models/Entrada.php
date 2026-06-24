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

    protected static function booted(): void
    {
        static::saving(function (Entrada $entrada) {
            if (filled($entrada->quantidade_recebida) && $entrada->status !== 'confirmado') {
                $entrada->status = 'confirmado';
                $entrada->data_confirmacao = $entrada->data_confirmacao ?? now();
            }
        });

        static::created(function (Entrada $entrada) {
            if ($entrada->status === 'aguardando_entrega' && $entrada->insumo_id) {
                $estoque = Estoque::firstOrCreate(['insumo_id' => $entrada->insumo_id]);
                $estoque->increment('aguardando_entrega', $entrada->quantidade_pedida);
            }
        });

        static::saved(function (Entrada $entrada) {
            if ($entrada->wasChanged('status') && $entrada->status === 'confirmado' && $entrada->insumo_id) {
                $estoque = Estoque::firstOrCreate(['insumo_id' => $entrada->insumo_id]);

                $estoque->increment('estoque_total', $entrada->quantidade_recebida);
                $estoque->decrement('aguardando_entrega', min($entrada->quantidade_pedida, $estoque->aguardando_entrega));
                $estoque->update(['atualizado_em' => now()]);
            }
        });
    }
}
