<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $insumos = DB::table('insumos')->select('id', 'valor_custo')->get();

        Schema::table('insumos', function (Blueprint $table) {
            $table->decimal('custo_unitario', 10, 2)->nullable()->after('qtd_por_caixa');
            $table->decimal('custo_caixa', 10, 2)->nullable()->after('custo_unitario');
        });

        foreach ($insumos as $insumo) {
            DB::table('insumos')->where('id', $insumo->id)->update(['custo_unitario' => $insumo->valor_custo]);
        }

        Schema::table('insumos', function (Blueprint $table) {
            $table->dropColumn('valor_custo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->decimal('valor_custo', 10, 2)->nullable();
        });

        Schema::table('insumos', function (Blueprint $table) {
            $table->dropColumn(['custo_unitario', 'custo_caixa']);
        });
    }
};
