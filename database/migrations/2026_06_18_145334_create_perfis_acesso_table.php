<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perfis_acesso', function (Blueprint $table) {
            $table->id();
            $table->string('nome_perfil');
            $table->boolean('pode_cadastrar')->default(false);
            $table->boolean('pode_movimentar_estoque')->default(false);
            $table->boolean('pode_gerenciar_kanban')->default(false);
            $table->boolean('pode_visualizar_relatorios')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfis_acesso');
    }
};
