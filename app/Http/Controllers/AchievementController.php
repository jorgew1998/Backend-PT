<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    //Función para la obtención la lista de logros
    public function index()
    {
        return Achievement::all();
    }

    //Función para la obtención de un logro en específico
    public function show(Achievement $achievement)
    {
        return $achievement;
    }

    public function image(Achievement $achievement)
    {
        return response()->download(public_path(Storage::url($achievement->image)));
    }

    //Funcion para la creación de logros
    public function store(Request $request)
    {
        //Comprobación de permisos
        $this->authorize('create', Achievement::class);

        //Validación de los campos para crear un nuevo logro
        $validatedData = $request->validate([
            'title' => 'required|string|unique:achievements',
            'item_1' => 'required|string',
            'item_2' => 'required|string',
            'item_3' => 'required|string',
            'item_4' => 'required|string',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
        ]);

        $achievement = new Achievement($request->all());
        $path = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        $achievement->image = $path;
        $achievement->save();
        return response()->json($achievement, 201);
    }

    //Función para la actualizacion de un logro en específico
    public function update(Request $request, Achievement $achievement)
    {
        //Comprobación de permisos
        $this->authorize('update', $achievement);

        //Validación de los campos para actualizar un logro
        $validatedData = $request->validate([
            'title' => 'string|unique:achievements',
            'item_1' => 'string',
            'item_2' => 'string',
            'item_3' => 'string',
            'item_4' => 'string',
            'image' => 'image|dimensions:min_width=200,min_height=200',
        ]);

        $achievement->update($request->all());
        return response()->json($achievement, 200);
    }

    //Función para la eliminación de un logro en específico
    public function delete(Achievement $achievement)
    {
        $this->authorize('delete', $achievement);
        $achievement->delete();
        return response()->json(null, 204);
    }

}
