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

    protected static function booted(): void
    {
        static::saving(function (MaterialEmUso $materialEmUso) {
            if ($materialEmUso->isDirty('status') && $materialEmUso->status === 'baixado') {
                $materialEmUso->baixado_em = $materialEmUso->baixado_em ?? now();
            }
        });

        static::saved(function (MaterialEmUso $materialEmUso) {
            if ($materialEmUso->wasChanged('status') && $materialEmUso->status === 'baixado') {
                $estoque = Estoque::query()
                    ->when($materialEmUso->insumo_id, fn ($query) => $query->where('insumo_id', $materialEmUso->insumo_id))
                    ->when($materialEmUso->material_id, fn ($query) => $query->where('material_id', $materialEmUso->material_id))
                    ->first();

                $estoque?->decrement('estoque_total', $materialEmUso->quantidade_atribuida);
            }
        });
    }
}
