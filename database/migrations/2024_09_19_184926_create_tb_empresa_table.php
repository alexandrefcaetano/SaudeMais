<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_empresa', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('nomefantasia', 145)->nullable();
            $table->string('status', 1)->nullable();
            $table->string('nif', 30)->nullable();
            $table->string('razaosocial', 150)->nullable();
            $table->string('ramoatividade', 100)->nullable();
            $table->string('morada', 145)->nullable();
            $table->string('corretor', 145)->nullable();
            $table->json('contato')->nullable();
            $table->text('observacao')->nullable();
            $table->string('visualizarrelatendimento', 1)->nullable();

            $table->unsignedBigInteger('seguradora_id')->nullable();
            $table->foreign('seguradora_id')
                  ->references('id_seguradora')
                  ->on('tb_seguradora')
                  ->onDelete('set null');


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
        Schema::dropIfExists('tb_empresa');
    }
}
