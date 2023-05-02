<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Personaje;

class PersonajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shrek = new Personaje([
            'nombre' => 'Shrek',
            'imagen' => 'https://static.wikia.nocookie.net/featteca/images/9/98/Shrek.png/revision/latest/scale-to-width-down/600?cb=20220713043820&path-prefix=es',
            'descripcion' => 'Ogro color verde',
        ]);

        $shrek->save();

        $shrek->peliculas()->attach([
            1,2,
        ]);

        $mario = new Personaje([
            'nombre' => 'Mario',
            'imagen' => 'https://www.elsoldehermosillo.com.mx/doble-via/968mpt-mario-bros/alternates/LANDSCAPE_768/Mario%20Bros',
            'descripcion' => 'Humano con traje rojo',
        ]);

        $mario->save();

        $mario->peliculas()->attach([
            3,
        ]);
    }
}
