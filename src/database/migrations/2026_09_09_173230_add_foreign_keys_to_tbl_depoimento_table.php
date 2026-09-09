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
        Schema::table('tbl_depoimento', function (Blueprint $table) {
            $table->foreign(['id_cliente'], 'fk_depoimento_cliente')->references(['id_cliente'])->on('tbl_cliente')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_depoimento', function (Blueprint $table) {
            $table->dropForeign('fk_depoimento_cliente');
        });
    }
};
