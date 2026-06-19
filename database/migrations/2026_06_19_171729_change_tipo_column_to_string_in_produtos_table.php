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
        $produtos = DB::table('produtos')->select('id', 'tipo')->get();

        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->string('tipo')->default('principal')->after('nome');
        });

        foreach ($produtos as $produto) {
            DB::table('produtos')->where('id', $produto->id)->update(['tipo' => $produto->tipo]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->enum('tipo', ['principal', 'componente'])->default('principal')->after('nome');
        });
    }
};
