<?php

namespace App\Http\Controllers;

use App\Models\ThemeDetail;
use Illuminate\Http\Request;

class ThemeDetailController extends Controller
{
    //Función para la obtención de el detalle de tema del usuario con sesión activa
    public function index()
    {
        //Comprobación de permisos
        $this->authorize('viewAny', ThemeDetail::class);

        $detailList = ThemeDetail::all();
        $details = [];

        foreach ($detailList as $detail) {
            if($detail->user_id === auth()->user()->id){
                $details[] = $detail;
            }
        }
        return response()-> json($details, 200);
    }

    //Función para la obtención de el detalle especifico de tema del usuario con sesión activa
    public function show(ThemeDetail $theme)
    {
        //Comprobación de permisos
        $this->authorize('view', $theme);

        return $theme;
    }

    //Función para la creación de un detalle de tema
    public function store(Request $request)
    {
        //Comprobación de permisos
        $this->authorize('create', ThemeDetail::class);

        //Validación de los campos para crear un nuevo detalle de tema
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'theme_id' => 'required|exists:themes,id',
            'theme_advance' => 'required|string',
        ]);

        return ThemeDetail::create($request->all());
    }

    //Función para la actualización de un detalle de tema
    public function update(Request $request, ThemeDetail $theme)
    {
        //Comprobación de permisos
        $this->authorize('update', $theme);

        //Validación de los campos para actualizar un detalle de tema
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id',
            'theme_id' => 'exists:themes,id',
            'theme_advance' => 'string',
        ]);

        $theme->update($request->all());
        return response()->json($theme, 200);
    }

    //Función para la eliminación de un detalle de tema
    public function delete(ThemeDetail $theme)
    {
        //Comprobación de permisos
        $this->authorize('delete', $theme);

        $theme->delete();
        return response()->json(null, 204);
    }
}
