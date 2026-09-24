<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Venda por local (comanda):
     * - id_local: mesa/balcão onde a venda acontece
     * - origem_venda: DASHBOARD (funcionário) ou APP (cliente pelo QR Code - futuro)
     * - cliente, forma de pagamento e observação passam a ser opcionais
     *   (a comanda abre sem pagamento e o balcão pode vender sem identificar o cliente)
     */
    public function up(): void
    {
        Schema::table('tbl_venda', function (Blueprint $table) {
            $table->integer('id_local')->nullable()->after('id_cliente')->index('fk_venda_local');
            $table->string('origem_venda', 10)->default('DASHBOARD')->after('id_local');

            $table->integer('id_cliente')->nullable()->change();
            $table->string('forma_pagamento_venda', 10)->nullable()->change();
            $table->string('observacao_venda', 100)->nullable()->change();

            $table->foreign(['id_local'], 'fk_venda_local')->references(['id_local'])->on('tbl_local')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_venda', function (Blueprint $table) {
            $table->dropForeign('fk_venda_local');
            $table->dropIndex('fk_venda_local');
            $table->dropColumn(['id_local', 'origem_venda']);

            $table->integer('id_cliente')->nullable(false)->change();
            $table->string('forma_pagamento_venda', 10)->nullable(false)->change();
            $table->string('observacao_venda', 100)->nullable(false)->change();
        });
    }
};
