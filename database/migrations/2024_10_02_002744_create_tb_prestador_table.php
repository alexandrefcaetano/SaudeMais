<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPrestadorTable extends Migration
{
    public function up()
    {
        Schema::create('tb_prestador', function (Blueprint $table) {
            $table->id('id_prestador');
            $table->string('especialidade_id', 1000)->nullable();
            $table->unsignedInteger('provincia_id')->nullable();
            $table->unsignedInteger('municipio_id')->nullable();
            $table->unsignedInteger('pais_id')->nullable();
            $table->string('seguradora_id', 1000);
            $table->string('tipoatendimento_id', 1000)->nullable();
            $table->unsignedInteger('banco_id')->nullable();
            $table->string('tipopessoa', 30)->nullable();
            $table->string('razaosocial', 150)->nullable();
            $table->string('nomefantasia', 150)->nullable();
            $table->unsignedInteger('idTipoprestador')->nullable();
            $table->text('observacao')->nullable();
            $table->string('nif', 40)->nullable();
            $table->char('ativo', 1)->nullable();
            $table->decimal('cambio', 18, 2)->nullable();
            $table->string('iban', 35)->nullable();
            $table->jsonb('contato')->nullable();
            $table->decimal('cotacaodolar', 18, 2);
            $table->string('codigoprestador', 20)->nullable();
            $table->binary('logoprestador')->nullable();
            $table->decimal('descontoprescricao', 18, 2)->nullable();
            $table->char('seguroplano', 1)->nullable();
            $table->char('descontoprescricaoacesso', 1)->nullable();
            $table->char('exibirsite', 1)->nullable();
            $table->char('aptocheckup', 1)->nullable();
            $table->string('contacorrente', 25)->nullable();
            $table->unsignedInteger('prazopagamento')->nullable();
            $table->char('utilizadigital', 1)->default('N');
            $table->text('lat')->nullable();
            $table->text('long')->nullable();
            $table->string('geolocalizacao', 145)->nullable();
            $table->date('dtiniciovontrato')->nullable();
            $table->char('exigirvalorprocedimento', 1)->default('N');
            $table->string('convertervalorMoeda', 50)->nullable();
            $table->decimal('acrescimomoeda', 18, 2)->nullable();
            $table->char('liberarguiaGratuita', 1)->default('N');
            $table->char('seguirregracoparticipacao', 1)->default('S');
            $table->string('responsavelfinanceiro', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_prestador');
    }
}
