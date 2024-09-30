<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSeguradoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_seguradora', function (Blueprint $table) {
            $table->id('id_seguradora');
            $table->string('seguradora', 100);
            $table->string('nif', 30);
            $table->string('ativo', 1);
            $table->string('exibirsite', 1)->nullable();
            $table->string('endereco', 150)->nullable();
            $table->json('contato')->nullable();
            $table->string('exibirdanoscorporais', 1)->default('N');
            $table->timestamps(); // Para created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_seguradora');
    }
}
