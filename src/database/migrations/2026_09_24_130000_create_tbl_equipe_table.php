<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Equipe exibida no site (seção "Quem Somos") - separada dos usuários do sistema
     */
    public function up(): void
    {
        Schema::create('tbl_equipe', function (Blueprint $table) {
            $table->integer('id_equipe', true);
            $table->string('nome_equipe', 50);
            $table->string('cargo_equipe', 50);
            $table->string('foto_equipe', 65);
            $table->integer('ordem_equipe')->default(0);
            $table->string('status_equipe', 10);
            $table->dateTime('data_criacao_equipe')->useCurrent();
            $table->dateTime('data_atualizacao_equipe')->useCurrentOnUpdate()->useCurrent();
        });

        // A equipe que já aparecia fixa no site (fotos em public/barista/img/equipe)
        DB::table('tbl_equipe')->insert([
            ['id_equipe' => 1, 'nome_equipe' => 'Lucas Ribeiro', 'cargo_equipe' => 'Barista Especialista', 'foto_equipe' => 'equipe/lucas-ribeiro_1.png', 'ordem_equipe' => 1, 'status_equipe' => 'ATIVO'],
            ['id_equipe' => 2, 'nome_equipe' => 'Mariana Alves', 'cargo_equipe' => 'Mestre de Torra', 'foto_equipe' => 'equipe/mariana-alves_2.png', 'ordem_equipe' => 2, 'status_equipe' => 'ATIVO'],
            ['id_equipe' => 3, 'nome_equipe' => 'Renato Silva', 'cargo_equipe' => 'Atendimento e Experiência do Cliente', 'foto_equipe' => 'equipe/renato-silva_3.png', 'ordem_equipe' => 3, 'status_equipe' => 'ATIVO'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_equipe');
    }
};
