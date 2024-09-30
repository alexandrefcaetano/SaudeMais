<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPlanoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_plano', function (Blueprint $table) {
            $table->id('id_plano');
            $table->string('plano', 100)->nullable();
            $table->decimal('valor', 18, 2)->nullable();
            $table->string('ativo', 1)->nullable();
            $table->integer('validade')->nullable();
            $table->string('excluido', 1)->default('N');
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
        Schema::dropIfExists('tb_plano');
    }
}

