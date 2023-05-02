<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Personaje;
use App\Models\Peliculas;
use Illuminate\Http\Request;
//agregar resource
use App\Http\Resources\PersonajeResource;
use App\Http\Resources\PeliculaResource;
//importar validator
use Illuminate\Support\Facades\Validator;

class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personajes = Personaje::with('peliculas')->get();

        return response([
            'personajes' => PersonajeResource::collection($personajes),
            'mensaje' => 'Desplegando lista de personajes'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nombre' => 'required|max:255',
            'imagen' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'peliculas' => 'required|array',
            'peliculas.*' => 'exists:peliculas,id'
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(),
            'mensaje' => 'ha ocurrido un error'], 400);
        }
    
        $personaje = Personaje::create([
            'nombre' => $data['nombre'],
            'imagen' => $data['imagen'],
            'descripcion' => $data['descripcion']
        ]);
    
        $personaje->peliculas()->attach($data['peliculas']);
    
        return response(['personaje' => new PersonajeResource($personaje), 'message' => 'Personaje agregado'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personaje = Personaje::with('peliculas')->findOrFail($id);
    return response(['personaje' => new PersonajeResource($personaje), 'mensaje' => 'Desplegando personaje'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $personaje = Personaje::findOrFail($id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'nombre' => 'max:255',
            'imagen' => 'max:255',
            'descripcion' => 'max:255',
            'peliculas' => 'array',
            'peliculas.*' => 'exists:peliculas,id'
        ]);
    
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'mensaje' => 'Ha ocurrido un error'], 400);
        }
    
        $personaje->update([
            'nombre' => $data['nombre'] ?? $personaje->nombre,
            'imagen' => $data['imagen'] ?? $personaje->imagen,
            'descripcion' => $data['descripcion'] ?? $personaje->descripcion
        ]);
    
        if (isset($data['peliculas'])) {
            $personaje->peliculas()->sync($data['peliculas']);
        }
    
        return response(['personaje' => new PersonajeResource($personaje), 'mensaje' => 'Personaje actualizado'], 200);
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personaje = Personaje::findOrFail($id);
        $personaje->delete();

        return response(['mensaje' => 'Personaje eliminado'], 200);
    }
}
