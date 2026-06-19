<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoEtapaProducao extends Model
{
    protected $table = 'historico_etapas_producao';

    protected $fillable = [
        'ordem_producao_id',
        'etapa_id',
        'entrou_em',
        'saiu_em',
        'movido_por',
    ];

    protected $casts = [
        'entrou_em' => 'datetime',
        'saiu_em' => 'datetime',
    ];

    public function ordemProducao()
    {
        return $this->belongsTo(OrdemProducao::class, 'ordem_producao_id');
    }

    public function etapa()
    {
        return $this->belongsTo(EtapaKanban::class, 'etapa_id');
    }

    public function movidoPor()
    {
        return $this->belongsTo(\App\Models\User::class, 'movido_por');
    }
}
