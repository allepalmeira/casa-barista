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
        Schema::create('tbl_news', function (Blueprint $table) {
            $table->integer('id_news', true);
            $table->string('email_news', 80)->unique('email_news');
            $table->integer('aceite_news')->default(1);
            $table->dateTime('data_criacao_news')->useCurrent();
            $table->dateTime('data_atualizacao_news')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_news');
    }
};
