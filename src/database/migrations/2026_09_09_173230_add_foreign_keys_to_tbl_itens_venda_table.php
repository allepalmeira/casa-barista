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
        Schema::table('tbl_itens_venda', function (Blueprint $table) {
            $table->foreign(['id_produto'], 'fk_itens_venda_produto')->references(['id_produto'])->on('tbl_produto')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_venda'], 'fk_itens_venda_venda')->references(['id_venda'])->on('tbl_venda')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_itens_venda', function (Blueprint $table) {
            $table->dropForeign('fk_itens_venda_produto');
            $table->dropForeign('fk_itens_venda_venda');
        });
    }
};
