<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemProducao extends Model
{
    protected $table = 'ordens_producao';

    protected $fillable = [
        'produto_id',
        'quantidade',
        'etapa_atual_id',
        'status_geral',
        'criado_por',
        'concluido_em',
    ];

    protected $casts = [
        'concluido_em' => 'datetime',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function etapaAtual()
    {
        return $this->belongsTo(EtapaKanban::class, 'etapa_atual_id');
    }

    public function criadoPor()
    {
        return $this->belongsTo(\App\Models\User::class, 'criado_por');
    }

    public function historico()
    {
        return $this->hasMany(HistoricoEtapaProducao::class, 'ordem_producao_id');
    }

    protected static function booted(): void
    {
        static::created(function (OrdemProducao $ordem) {
            if ($ordem->etapa_atual_id) {
                $ordem->historico()->create([
                    'etapa_id' => $ordem->etapa_atual_id,
                    'entrou_em' => now(),
                ]);
            }
        });
    }
}
