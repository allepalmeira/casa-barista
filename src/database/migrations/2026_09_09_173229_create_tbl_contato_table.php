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
        Schema::create('tbl_contato', function (Blueprint $table) {
            $table->integer('id_contato', true);
            $table->string('nome_contato', 50);
            $table->string('email_contato', 80);
            $table->string('telefone_contato', 14);
            $table->string('assunto_contato', 7);
            $table->text('mensagem_contato');
            $table->string('status_contato', 10);
            $table->dateTime('data_criacao_contato')->useCurrent();
            $table->dateTime('data_atualizacao_contato')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contato');
    }
};
