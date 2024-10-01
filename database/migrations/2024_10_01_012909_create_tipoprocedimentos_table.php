<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoprocedimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoprocedimentos', function (Blueprint $table) {
            $table->bigIncrements('id_tipoprocedimento'); // Auto increment primary key
            $table->string('principal', 100)->nullable(); // Nullable varchar
            $table->string('secundaria', 100)->nullable(); // Nullable varchar
            $table->string('ativo', 1)->default('N')->nullable(); // Default value and nullable
            $table->timestamp('dtInclusao')->nullable(); // Nullable datetime

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
        Schema::dropIfExists('tipoprocedimentos');
    }
}
