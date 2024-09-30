<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBancoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_banco', function (Blueprint $table) {
            $table->increments('id_banco');
            $table->string('banco', 100)->nullable();
            $table->string('ativo', 1)->nullable();
            $table->integer('provincia_id')->nullable();
            $table->integer('municipio_id')->nullable();
            $table->integer('pais_id')->nullable();
            $table->string('codigoSwift', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_banco');
    }
}
