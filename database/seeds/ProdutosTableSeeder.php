<?php

use Illuminate\Database\Seeder;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(
            [
                'titulo' => "Vingadores Ultimato",
                'sinopse' => 'Sinopse',
                'valor' => 90.00,
                'capa' => "https://videoperola.vteximg.com.br/arquivos/ids/173757-1000-1000/dvd.jpg?v=636970863249300000",
                'trailer' => "<iframe width='560' height='315' src='https://www.youtube.com/embed/dka9J5sY80g' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>",
                'ano' => 2010,
                'estudio_id' => 2,
                'lancamento' => 'S',
                'classificacao' => 5
            ]
        );
    }
}


