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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insumo_id')->nullable()->constrained('insumos')->onDelete('set null');
            $table->string('fornecedor')->nullable();
            $table->enum('status', ['aguardando_entrega', 'confirmado'])->default('aguardando_entrega');
            $table->decimal('quantidade_pedida', 10, 3)->default(0);
            $table->decimal('quantidade_recebida', 10, 3)->nullable();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('data_pedido')->nullable();
            $table->timestamp('data_confirmacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
