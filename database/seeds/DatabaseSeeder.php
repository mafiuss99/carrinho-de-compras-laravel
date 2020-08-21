<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenerosTableSeeder::class);
        $this->call(EstudiosTableSeeder::class);
        $this->call(ProdutosTableSeeder::class);
    }
}
