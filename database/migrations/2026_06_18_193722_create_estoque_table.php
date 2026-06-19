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
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insumo_id')->nullable()->constrained('insumos')->onDelete('cascade');
            $table->foreignId('material_id')->nullable()->constrained('materiais')->onDelete('cascade');
            $table->decimal('estoque_total', 10, 3)->default(0);
            $table->decimal('aguardando_entrega', 10, 3)->default(0);
            $table->timestamp('atualizado_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};
