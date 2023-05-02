<?php

namespace Database\Seeders;

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
        //Ejecutar seeders
        $this->call(PeliculaSeeder::class);
        $this->call(PersonajeSeeder::class);
    }
}
