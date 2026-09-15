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
        Schema::create('tbl_usuarios_venda', function (Blueprint $table) {
            $table->integer('id_usuarios_venda', true);
            $table->integer('id_usuario')->index('fk_usuarios_venda_usuario');
            $table->integer('id_venda')->index('fk_usuarios_venda_venda');
            $table->dateTime('data_criacao_usuarios_venda')->useCurrent();
            $table->dateTime('data_atualizacao_usuarios_venda')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_usuarios_venda');
    }
};
