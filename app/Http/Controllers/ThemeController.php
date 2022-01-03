<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Http\Resources\Theme as ThemeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ThemeController extends Controller
{
    //Función para la obtención la lista de temas
    public function index()
    {
        return Theme::all();
    }

    //Funcion para obtener un tema en específico
    public function show(Theme $theme)
    {
        return $theme;
    }

    //Funcion para la creación de temas
    public function store(Request $request)
    {
        //Comprobación de permisos
        $this->authorize('create', Theme::class);

        //Validación de los campos para crear un nuevo tema
        $validatedData = $request->validate([
            'title' => 'required|string|unique:themes',
            'description' => 'required|string',
            'difficulty' => 'required|string',
        ]);

        $achievement = Theme::create($request->all());
        return response()->json($achievement,201);

    }

    //Función para la actualizacion de un tema en específico
    public function update(Request $request, Theme $theme)
    {
        //Comprobación de permisos
        $this->authorize('update', $theme);

        //Validación de los campos para actualizar un tema
        $validatedData = $request->validate([
            'title' => 'string|unique:themes',
            'description' => 'string',
            'difficulty' => 'string',
        ]);

        $theme->update($request->all());
        return response()->json($theme, 200);
    }

    //Función para la eliminación de un tema en específico
    public function delete(Theme $theme)
    {
        //Comprobación de permisos
        $this->authorize('delete', $theme);

        $theme->delete();
        return response()->json(null, 204);
    }

}
