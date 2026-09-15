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
        Schema::table('tbl_usuarios_venda', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'fk_usuarios_venda_usuario')->references(['id_usuarios'])->on('tbl_usuarios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_venda'], 'fk_usuarios_venda_venda')->references(['id_venda'])->on('tbl_venda')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_usuarios_venda', function (Blueprint $table) {
            $table->dropForeign('fk_usuarios_venda_usuario');
            $table->dropForeign('fk_usuarios_venda_venda');
        });
    }
};
