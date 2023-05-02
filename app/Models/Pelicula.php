<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;
    public $timestamps = false;//inhabilitar

    //relacion con tabla Personaje
    public function personajes() { 
        return $this->belongsToMany(Personaje::class, 'pelicula_personaje', 'pelicula_id', 'personaje_id'); 
      } 

    //que se debe llenar
    protected $fillable = [
        'nombre',
        'clasificacion',
        'estreno',
        'review'     
    ];
}
