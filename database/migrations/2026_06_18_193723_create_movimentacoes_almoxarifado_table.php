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
        Schema::create('movimentacoes_almoxarifado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colaborador_id')->nullable()->constrained('colaboradores')->onDelete('set null');
            $table->foreignId('insumo_id')->nullable()->constrained('insumos')->onDelete('set null');
            $table->foreignId('material_id')->nullable()->constrained('materiais')->onDelete('set null');
            $table->decimal('quantidade', 10, 3)->default(0);
            $table->enum('tipo_movimentacao', ['saida', 'ajuste', 'devolucao']);
            $table->text('observacao')->nullable();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes_almoxarifado');
    }
};
