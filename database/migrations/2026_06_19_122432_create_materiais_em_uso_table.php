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
        Schema::create('materiais_em_uso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->onDelete('cascade');
            $table->foreignId('insumo_id')->nullable()->constrained('insumos')->onDelete('set null');
            $table->foreignId('material_id')->nullable()->constrained('materiais')->onDelete('set null');
            $table->decimal('quantidade_atribuida', 10, 3)->default(0);
            $table->enum('status', ['em_uso', 'baixado'])->default('em_uso');
            $table->text('observacao_baixa')->nullable();
            $table->timestamp('atribuido_em')->nullable();
            $table->timestamp('baixado_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais_em_uso');
    }
};
