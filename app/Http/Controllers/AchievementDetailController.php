<?php

namespace App\Http\Controllers;

use App\Models\AchievementDetail;
use App\Models\Theme;
use Illuminate\Http\Request;

class AchievementDetailController extends Controller
{
    //Función para la obtención de el detalle de logro del usuario con sesión activa
    public function index()
    {
        //Comprobación de permisos
        $this->authorize('viewAny', AchievementDetail::class);

        $detailList = AchievementDetail::all();
        $details = [];

        foreach ($detailList as $detail) {
        if($detail->user_id === auth()->user()->id){
            $details[] = $detail;
          }
        }
         return response()-> json($details, 200);
    }

    //Función para la obtención de el detalle especifico de logro del usuario con sesión activa
    public function show(AchievementDetail $achievement)
    {
        //Comprobación de permisos
        $this->authorize('view', $achievement);

        return $achievement;
    }

    //Función para la creación de un detalle de logro
    public function store(Request $request)
    {
        //Comprobación de permisos
         $this->authorize('create', AchievementDetail::class);

        //Validación de los campos para crear un nuevo detalle de logro
         $validatedData = $request->validate([
             'achievement_id' => 'required|exists:achievements,id',
             'user_id' => 'required|exists:users,id',
             'theme_id' => 'required|exists:themes,id',
             'content_id' => 'required|exists:contents,id',
          ]);

        return AchievementDetail::create($request->all());
    }

    //Función para la actualización de un detalle de logro
    public function update(Request $request, AchievementDetail $achievement)
    {
        //Comprobación de permisos
        $this->authorize('update', $achievement);

        //Validación de los campos para actualizar un detalle de logro
        $validatedData = $request->validate([
            'achievement_id' => 'exists:achievements,id',
            'user_id' => 'exists:users,id',
            'theme_id' => 'exists:themes,id',
            'content_id' => 'exists:contents,id',
        ]);

        $achievement->update($request->all());
        return response()->json($achievement, 200);
    }

    //Función para la eliminación de un detalle de logro
    public function delete(AchievementDetail $achievement)
    {
        //Comprobación de permisos
        $this->authorize('delete', $achievement);

        $achievement->delete();
        return response()->json(null, 204);
    }
}
