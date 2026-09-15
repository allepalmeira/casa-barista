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
        Schema::create('tbl_horarios', function (Blueprint $table) {
            $table->integer('id_horarios', true);
            $table->string('dia_semana_horarios', 15);
            $table->time('hora_abertura_horarios');
            $table->time('hora_fechamento_horarios');
            $table->string('observacao_horarios', 100);
            $table->string('status_horarios', 10);
            $table->dateTime('data_criacao_horarios')->useCurrent();
            $table->dateTime('data_atualizacao_horarios')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_horarios');
    }
};
