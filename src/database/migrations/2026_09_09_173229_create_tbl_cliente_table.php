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
        Schema::create('tbl_cliente', function (Blueprint $table) {
            $table->integer('id_cliente', true);
            $table->string('nome_cliente', 50);
            $table->string('email_cliente', 80)->unique('email_cliente');
            $table->string('senha_cliente');
            $table->string('foto_cliente', 65);
            $table->string('status_cliente', 10);
            $table->dateTime('data_criacao_cliente')->useCurrent();
            $table->dateTime('data_atualizacao_cliente')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cliente');
    }
};
