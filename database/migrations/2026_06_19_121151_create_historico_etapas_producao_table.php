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
        Schema::create('historico_etapas_producao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_producao_id')->constrained('ordens_producao')->onDelete('cascade');
            $table->foreignId('etapa_id')->constrained('etapas_kanban')->onDelete('cascade');
            $table->timestamp('entrou_em')->nullable();
            $table->timestamp('saiu_em')->nullable();
            $table->foreignId('movido_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_etapas_producao');
    }
};
