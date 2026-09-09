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
        Schema::create('tbl_usuarios', function (Blueprint $table) {
            $table->integer('id_usuarios', true);
            $table->string('nome_usuarios', 50);
            $table->string('email_usuarios', 80)->unique('email_usuarios');
            $table->string('senha_usuarios');
            $table->string('foto_usuarios', 65);
            $table->string('nivel_usuarios', 15);
            $table->string('status_usuarios', 10);
            $table->dateTime('data_criacao_usuarios')->useCurrent();
            $table->dateTime('data_atualizacao_usuarios')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_usuarios');
    }
};
