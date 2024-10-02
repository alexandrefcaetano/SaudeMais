<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoberturaLimiteTable extends Migration
{
    public function up()
    {
        Schema::create('tb_coberturalimite', function (Blueprint $table) {
            $table->increments('id_coberturaLimite');
            $table->unsignedBigInteger('cobertura_id');
            $table->string('coberturalimite', 150)->nullable();
            $table->char('status', 1)->nullable();
            $table->char('statuspadrao', 1)->nullable();
            $table->char('alertasms', 1)->default('N')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coberturalimite');
    }
}
