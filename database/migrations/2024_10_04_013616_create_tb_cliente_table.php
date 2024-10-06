
<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

class CreateTbClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cliente', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->unsignedBigInteger('plano_id')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->unsignedBigInteger('agente_id')->nullable();
            $table->unsignedBigInteger('seguradora_id')->nullable();
            $table->unsignedBigInteger('postocoleta_id')->nullable();
            $table->unsignedBigInteger('apoliceplano_id')->nullable();
            $table->unsignedBigInteger('apolice_id')->nullable();
            $table->unsignedBigInteger('banco_id')->nullable();
            $table->string('numerocartao', 40)->nullable();
            $table->string('nome', 145)->nullable();
            $table->string('genero', 45)->nullable();
            $table->jsonb('contato')->nullable();
            $table->date('datanascimento')->nullable();
            $table->string('ativo', 1)->nullable();
            $table->string('nif', 30)->nullable();
            $table->integer('lote')->nullable();
            $table->string('bi', 15)->nullable();
            $table->integer('validade')->nullable();
            $table->date('dataativacao')->nullable();
            $table->string('divisao', 100)->nullable();
            $table->date('dtiniciovigencia')->nullable();
            $table->date('dtfimvigencia')->nullable();
            $table->string('estadocivil', 30)->nullable();
            $table->string('parentesco', 30)->nullable();
            $table->date('datacancelamento')->nullable();
            $table->text('motivocancelamento')->nullable();
            $table->string('situacao', 100)->nullable();
            $table->integer('diascarencia')->nullable();
            $table->string('numeroempregado', 100)->nullable();
            $table->string('lotacao', 145)->nullable();
            $table->string('cargoempregado', 145)->nullable();
            $table->string('redeinternacional', 1)->default('N')->nullable();
            $table->integer('periodopagamento')->nullable();
            $table->string('seguirregracarencia', 1)->default('S')->nullable();
            $table->dateTime('dtreferencia')->nullable();
            $table->string('origem', 1)->default('S')->nullable();
            $table->binary('foto')->nullable();
            $table->string('alertasms', 1)->default('N')->nullable();
            $table->string('contacorrente', 25)->default('N')->nullable();
            $table->string('iban', 35)->default('N')->nullable();
            $table->string('fcmtoken', 1000)->nullable();
            $table->string('carencia', 1)->default('N')->nullable();
            $table->string('numeroseguradora', 30)->nullable();
            $table->string('naoperturbeemail', 1)->nullable();
            $table->date('dataprogramadacancelamento')->nullable();
            $table->string('beneficiarionecessitaautorizacao', 1)->default('N')->nullable();

            $table->timestamps(); // adiciona os campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cliente');
    }
}

