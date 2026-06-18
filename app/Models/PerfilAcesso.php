<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilAcesso extends Model
{
    protected $table = 'perfis_acesso';

    protected $fillable = [
        'nome_perfil',
        'pode_cadastrar',
        'pode_movimentar_estoque',
        'pode_gerenciar_kanban',
        'pode_visualizar_relatorios',
    ];

    protected $casts = [
        'pode_cadastrar' => 'boolean',
        'pode_movimentar_estoque' => 'boolean',
        'pode_gerenciar_kanban' => 'boolean',
        'pode_visualizar_relatorios' => 'boolean',
    ];
}
