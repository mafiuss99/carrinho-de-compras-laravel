<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('titulo');
            $table->text('sinopse');
            $table->decimal('valor', 6, 2)->default(0);
            $table->string('capa');
            $table->text('trailer');
            $table->integer('ano');
            $table->enum('ativo', ['S', 'N'])->default('S');
            $table->enum('destaque', ['S', 'N'])->default('N');
            $table->enum('lancamento', ['S', 'N'])->default('N');
            $table->integer('estudio_id')->unsigned(); // usigned: somente inteiros positivos
            $table->integer('classificacao')->default(0);
            $table->timestamps();
            
            $table->foreign('estudio_id')->references('id')->on('estudios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
