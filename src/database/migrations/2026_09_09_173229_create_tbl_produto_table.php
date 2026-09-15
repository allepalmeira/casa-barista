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
        Schema::create('tbl_produto', function (Blueprint $table) {
            $table->integer('id_produto', true);
            $table->string('nome_produto', 30);
            $table->integer('id_categoria')->index('fk_produto_categoria');
            $table->string('descricao_curta_produto', 100);
            $table->text('descricao_longa_produto')->nullable();
            $table->double('valor_produto');
            $table->string('imagem_produto', 45);
            $table->integer('destaque_produto')->default(0);
            $table->string('status_produto', 10);
            $table->dateTime('data_criacao_produto')->useCurrent();
            $table->dateTime('data_atualizacao_produto')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_produto');
    }
};
