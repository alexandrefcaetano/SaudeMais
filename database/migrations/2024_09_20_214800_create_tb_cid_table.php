<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCidTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cid', function (Blueprint $table) {
            $table->id('id_cid'); // Chave primária auto_increment
            $table->string('codigo_cid', 45)->nullable();
            $table->string('cid', 500)->nullable();
            $table->string('tiporegra', 45)->nullable();
            $table->string('ativo', 1)->nullable();
            $table->string('cobertura_id', 50)->nullable();
            $table->integer('cobertura_limite_id')->nullable();
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
        Schema::dropIfExists('tb_cid');
    }
}
