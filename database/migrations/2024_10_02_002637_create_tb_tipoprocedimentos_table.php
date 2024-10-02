<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTipoProcedimentosTable extends Migration
{
    public function up()
    {
        Schema::create('tb_tipoprocedimentos', function (Blueprint $table) {
            $table->id('id_tipoprocedimento');
            $table->string('principal', 100)->nullable();
            $table->string('secundaria', 100)->nullable();
            $table->char('ativo', 1)->default('N')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_tipoprocedimentos');
    }
}
