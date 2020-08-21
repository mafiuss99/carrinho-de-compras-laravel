<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneroProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genero_produtos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('produto_id')->unsigned(); // usigned: somente inteiros positivos
            $table->integer('genero_id')->unsigned();
            $table->timestamps();

            $table->foreign('genero_id')->references('id')->on('generos');
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
        Schema::dropIfExists('genero_produtos');
    }
}
