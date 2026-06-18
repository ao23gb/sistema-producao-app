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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('foto_url')->nullable();
            $table->string('codigo_id')->nullable();
            $table->string('codigo_interno')->nullable();
            $table->string('codigo_barras')->nullable();
            $table->enum('tipo_material', ['MDF', 'MDP'])->nullable();
            $table->decimal('espessura_mm', 8, 2)->nullable();
            $table->string('cor')->nullable();
            $table->decimal('valor_custo', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais');
    }
};
