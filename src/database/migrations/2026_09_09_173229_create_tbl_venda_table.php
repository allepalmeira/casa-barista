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
        Schema::create('tbl_venda', function (Blueprint $table) {
            $table->integer('id_venda', true);
            $table->dateTime('data_hora_venda');
            $table->double('valor_total_venda');
            $table->string('forma_pagamento_venda', 10);
            $table->integer('id_cliente')->index('fk_venda_cliente');
            $table->string('status_venda', 12)->default('EM ANDAMENTO');
            $table->string('observacao_venda', 100);
            $table->dateTime('data_criacao_venda')->useCurrent();
            $table->dateTime('data_atualizacao_venda')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_venda');
    }
};
