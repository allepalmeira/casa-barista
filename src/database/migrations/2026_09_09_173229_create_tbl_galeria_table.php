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
        Schema::create('tbl_galeria', function (Blueprint $table) {
            $table->integer('id_galeria', true);
            $table->string('nome_galeria', 50);
            $table->string('imagem_galeria', 65);
            $table->string('status_galeria', 10);
            $table->dateTime('data_criacao_galeria')->useCurrent();
            $table->dateTime('data_atualizacao_galeria')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_galeria');
    }
};
