<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';

    protected $fillable = [
        'nome',
        'login',
        'senha_hash',
        'perfil_id',
        'restringir_estoque',
    ];

    protected $hidden = ['senha_hash'];

    protected $casts = [
        'restringir_estoque' => 'boolean',
    ];

    public function perfil()
    {
        return $this->belongsTo(PerfilAcesso::class, 'perfil_id');
    }
}
