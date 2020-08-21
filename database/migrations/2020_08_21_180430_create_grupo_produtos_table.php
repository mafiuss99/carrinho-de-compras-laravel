<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_produtos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('produto_id')->unsigned(); // usigned: somente inteiros positivos
            $table->integer('grupo_id')->unsigned();
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_produtos');
    }
}
