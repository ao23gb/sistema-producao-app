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
        Schema::create('ordens_producao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->integer('quantidade');
            $table->foreignId('etapa_atual_id')->nullable()->constrained('etapas_kanban')->onDelete('set null');
            $table->enum('status_geral', ['em_andamento', 'concluido'])->default('em_andamento');
            $table->foreignId('criado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('concluido_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens_producao');
    }
};
