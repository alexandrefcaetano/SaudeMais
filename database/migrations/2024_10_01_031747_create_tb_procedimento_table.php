<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProcedimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_procedimento', function (Blueprint $table) {
            $table->id('id_procedimento');

            $table->unsignedBigInteger('prestador_id');

            $table->unsignedBigInteger('cobertura_id')->nullable();
            $table->foreign('cobertura_id')
                ->references('id_cobertura')
                ->on('tb_cobertura')
                ->onDelete('set null');


            $table->unsignedBigInteger('tipoprocedimento_id')->nullable();
            $table->foreign('tipoprocedimento_id')
                ->references('id_tipoprocedimento')
                ->on('tb_tipoprocedimento')
                ->onDelete('set null');

            $table->unsignedBigInteger('tipoatendimento_id')->nullable();
            $table->foreign('tipoatendimento_id')
                ->references('id_tipoatendimento')
                ->on('tb_tipoatendimento')
                ->onDelete('set null');

            $table->unsignedBigInteger('coberturalimite_id')->nullable();
            $table->string('codservico', 20);
            $table->string('descricao', 500)->nullable();
            $table->string('ativo', 1)->nullable();
            $table->decimal('valor', 18, 5)->nullable();
            $table->decimal('vlrfaturado', 18, 5)->nullable();
            $table->decimal('vlrsaudemais', 18, 5)->nullable();
            $table->decimal('vlrdolar', 18, 5)->nullable();
            $table->decimal('vlrcotacao', 18, 5)->nullable();
            $table->string('tiporegra', 30)->nullable();
            $table->string('gratuito', 1)->nullable();
            $table->integer('quantidadeitens')->default(0)->nullable();
            $table->integer('quantidadedias')->default(0)->nullable();
            $table->string('ean', 255)->nullable();
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
        Schema::dropIfExists('tb_procedimento');
    }
}
