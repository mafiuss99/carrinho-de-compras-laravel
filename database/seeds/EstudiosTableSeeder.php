<?php

use Illuminate\Database\Seeder;

class EstudiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('estudios')->insert([
        
        [
            'nome' => "Warner Bros",
            'logo' => "null",
            'descricao' => "desc"
        ], 
        [
            'nome' => "Paramount",
            'logo' => "null",
            'descricao' => "desc"
        ],
        [
            'nome' => "Universal",
            'logo' => "null",
            'descricao' => "desc"
        ],
        [
            'nome' => "Disney",
            'logo' => "null",
            'descricao' => "desc"
        ],
        [
            'nome' => "Marvel",
            'logo' => "null",
            'descricao' => "desc"
        ]
        ]);
    }
}
