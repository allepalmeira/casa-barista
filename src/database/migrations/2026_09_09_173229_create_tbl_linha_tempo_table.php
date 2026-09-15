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
        Schema::create('tbl_linha_tempo', function (Blueprint $table) {
            $table->integer('id_linha_tempo', true);
            $table->string('titulo_linha_tempo', 30);
            $table->date('ano_linha_tempo');
            $table->string('descricao_linha_tempo');
            $table->string('status_linha_tempo', 10);
            $table->dateTime('data_criacao_linha_tempo')->useCurrent();
            $table->dateTime('data_atualizacao_linha_tempo')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_linha_tempo');
    }
};
