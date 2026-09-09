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
        Schema::create('tbl_banner', function (Blueprint $table) {
            $table->integer('id_banner', true);
            $table->string('titulo_banner', 50);
            $table->string('imagem_banner', 65);
            $table->string('status_banner', 10);
            $table->dateTime('data_criacao_banner')->useCurrent();
            $table->dateTime('data_atualizacao_banner')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_banner');
    }
};
