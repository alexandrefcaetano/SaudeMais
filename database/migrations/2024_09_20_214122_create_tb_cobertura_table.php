<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCoberturaTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cobertura', function (Blueprint $table) {
            $table->id('id_cobertura'); // Chave primária
            $table->string('cobertura', 100)->nullable();
            $table->string('ativo', 1)->nullable();
            $table->string('alertaSMS', 1)->default('N')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverte a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cobertura');
    }
}

