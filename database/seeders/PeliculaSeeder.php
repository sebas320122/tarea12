<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pelicula;

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peliculas')->insert([
            [ 
            'nombre' => 'Shrek 1', 
            'clasificacion' => 'animada', 
            'estreno' => '2001-06-29', 
            'review' => 'Excelente', 
            ],
            [ 
                'nombre' => 'Shrek 2', 
                'clasificacion' => 'animada', 
                'estreno' => '2004-06-15', 
                'review' => 'Excelente', 
            ],
            [ 
                'nombre' => 'Super Mario Bros', 
                'clasificacion' => 'animada', 
                'estreno' => '2023-04-06', 
                'review' => 'Buena',   
            ]
           
    ]);
    }
}
