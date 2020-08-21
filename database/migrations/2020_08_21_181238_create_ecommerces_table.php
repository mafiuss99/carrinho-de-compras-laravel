<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcommercesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('subtitulo');
            $table->string('logo');
            $table->string('cor_primaria');
            $table->string('cor_secundaria');
            $table->string('cor_fundo');
            $table->enum('banner_home_ativo', ['S', 'N'])->default('S');
            $table->string('banner_home');
            $table->enum('lancamentos_home_ativo', ['S', 'N'])->default('S');
            $table->enum('generos_home_ativo', ['S', 'N'])->default('S');
            $table->enum('destaques_home_ativo', ['S', 'N'])->default('S');
            $table->enum('grupos_home_ativo', ['S', 'N'])->default('S');
            $table->enum('estudios_home_ativo', ['S', 'N'])->default('S');
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('gmail')->nullable();
            $table->string('fone')->nullable();
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
        Schema::dropIfExists('ecommerces');
    }
}
