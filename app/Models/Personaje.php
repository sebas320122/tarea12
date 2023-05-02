<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    use HasFactory;
    public $timestamps = false;//inhabilitar

    //que se debe llenar
    protected $fillable = [
        'nombre',   
        'imagen',
        'descripcion'     
    ];
    
    //relacion con tabla Pelicula
    public function peliculas() { 
        return $this->belongsToMany(Pelicula::class, 'pelicula_personaje', 'personaje_id', 'pelicula_id'); 
      } 

}
