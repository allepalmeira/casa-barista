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
        Schema::create('tbl_itens_venda', function (Blueprint $table) {
            $table->integer('id_itens_venda', true);
            $table->integer('id_venda')->index('fk_itens_venda_venda');
            $table->integer('id_produto')->index('fk_itens_venda_produto');
            $table->double('qtde_itens_venda');
            $table->double('valor_unit_itens_venda');
            $table->double('subtotal_itens_venda');
            $table->string('status_itens_venda', 10)->default('CONFIRMADO');
            $table->dateTime('data_criacao_itens_venda')->useCurrent();
            $table->dateTime('data_atualizacao_itens_venda')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_itens_venda');
    }
};
