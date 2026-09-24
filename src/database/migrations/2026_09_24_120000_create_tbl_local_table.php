<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Locais de atendimento (mesas, balcão...) - cada um tem um QR Code
     */
    public function up(): void
    {
        Schema::create('tbl_local', function (Blueprint $table) {
            $table->integer('id_local', true);
            $table->string('nome_local', 30);
            $table->string('tipo_local', 10);

            // Código usado no QR Code (não é o id, para não dar para "adivinhar" outras mesas)
            $table->string('codigo_local', 20)->unique('codigo_local');

            $table->string('status_local', 10);
            $table->dateTime('data_criacao_local')->useCurrent();
            $table->dateTime('data_atualizacao_local')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_local');
    }
};
