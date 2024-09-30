<?php
// database/migrations/2024_09_20_123456_create_tb_especialidade_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEspecialidadeTable extends Migration
{
    public function up()
    {
        Schema::create('tb_especialidade', function (Blueprint $table) {
            $table->increments('id_especialidade');
            $table->string('especialidade', 150)->nullable();
            $table->char('ativo', 1)->default('S');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_especialidade');
    }
}
