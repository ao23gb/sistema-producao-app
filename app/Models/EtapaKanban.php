<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtapaKanban extends Model
{
    protected $table = 'etapas_kanban';

    protected $fillable = [
        'nome_etapa',
        'ordem',
        'ativa',
    ];

    protected $casts = [
        'ativa' => 'boolean',
    ];
}
