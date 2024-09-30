<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbApoliceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_apolice', function (Blueprint $table) {
            $table->id('id_apolice');
            $table->unsignedBigInteger('seguradora_id')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->text('prestadorexcecao_id')->nullable();

            $table->string('codigoapolice', 30)->nullable();
            $table->string('apolice', 40)->nullable();
            $table->string('planoapolice', 15)->nullable();
            $table->string('apoliceseguradora', 30)->nullable();
            $table->string('ipoMoeda', 15)->nullable();

            $table->decimal('valorlimiteapolice', 18, 2)->nullable();

            $table->date('dataIniciocobertura')->nullable();
            $table->date('datafimcobertura')->nullable();
            $table->date('datacancelamento')->nullable();
            $table->dateTime('datacadastro')->nullable();
            $table->dateTime('dataalteracao')->nullable();

            $table->char('excecaoatendimentoobstetricia', 1)->nullable();
            $table->char('renovacaolimite', 1)->nullable();
            $table->char('status', 1)->default('N')->nullable();
            $table->char('permitereembolso', 1)->nullable();
            $table->char('seguirtiporegra', 1)->default('S')->nullable();
            $table->char('redeinternacional', 1)->default('N')->nullable();
            $table->char('utilizadigital', 1)->default('N')->nullable();
            $table->char('regracronico', 1)->default('S')->nullable();
            $table->char('regraidoso', 1)->default('S')->nullable();
            $table->char('resseguro', 1)->default('N')->nullable();
            $table->char('liberarguiagratuita', 1)->default('N')->nullable();

            $table->text('motivocancelamento')->nullable();
            $table->text('observacao')->nullable();
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
        Schema::dropIfExists('tb_apolice');
    }
}

