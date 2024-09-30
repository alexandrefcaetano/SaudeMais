<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMedicoTable extends Migration
{
    public function up()
    {
        Schema::create('tb_medico', function (Blueprint $table) {
            $table->id('id_medico');
            $table->string('medico', 45);
            $table->string('crm', 50);
            $table->char('ativo', 1)->default('S');
            $table->char('tipo', 1)->nullable();
            $table->jsonb('contato');
            $table->string('senha', 400)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_medico');
    }
}

