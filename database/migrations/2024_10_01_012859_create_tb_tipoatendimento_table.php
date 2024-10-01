<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTipoatendimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tipoatendimento', function (Blueprint $table) {
            $table->bigIncrements('id_tipoatendimento'); // Auto increment primary key
            $table->string('acessos_id', 255)->nullable(); // Nullable varchar
            $table->string('coberturas_id', 255)->nullable(); // Nullable varchar
            $table->string('tipoatendimento', 100)->nullable(); // Nullable varchar
            $table->string('ativo', 1)->nullable(); // Nullable varchar
            $table->string('obrigatoriocid', 1)->default('N')->nullable(); // Default value and nullable

            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tipoatendimento');
    }
}

