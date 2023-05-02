<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pelicula;
use App\Http\Resources\PeliculaResource;
class PersonajeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $this->load('peliculas');
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'imagen' => $this->imagen,
            'descripcion' => $this->descripcion,
            'peliculas' => PeliculaResource::collection($this->whenLoaded('peliculas'))
        ];
    }
}
