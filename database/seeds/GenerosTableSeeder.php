<?php

use Illuminate\Database\Seeder;

class GenerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('generos')->insert([
        [
            'nome' => "Comédia",
            'imagem' => "null",
            'descricao' => "desc"
        ], 
        [
            'nome' => "Drama",
            'imagem' => "null",
            'descricao' => "desc"
        ],
        [
            'nome' => "Suspense",
            'imagem' => "null",
            'descricao' => "desc"
        ],
        [
            'nome' => "Aventura",
            'imagem' => "null",
            'descricao' => "desc"
        ],
        [
            'nome' => "Ação",
            'imagem' => "null",
            'descricao' => "desc"
        ]
        ]);
    }
}
