<?php

namespace App\Http\Controllers;

use App\Models\ContentDetail;
use Illuminate\Http\Request;

class ContentDetailController extends Controller
{
    //Función para la obtención de el detalle de contenido del usuario con sesión activa
    public function index()
    {
        //Comprobación de permisos
        $this->authorize('viewAny', ContentDetail::class);

        $detailList = ContentDetail::all();
        $details = [];

        foreach ($detailList as $detail) {
            if($detail->user_id === auth()->user()->id){
                $details[] = $detail;
            }
        }
        return response()-> json($details, 200);
    }

    //Función para la obtención de el detalle especifico de contenido del usuario con sesión activa
    public function show(ContentDetail $content)
    {
        //Comprobación de permisos
        $this->authorize('view', $content);

        return $content;
    }

    //Función para la creación de un detalle de contenido
    public function store(Request $request)
    {
        //Comprobación de permisos
         $this->authorize('create', ContentDetail::class);

        //Validación de los campos para crear un nuevo detalle de contenido
        $validatedData = $request->validate([
            'content_id' => 'required|exists:contents,id',
            'user_id' => 'required|exists:users,id',
            'theme_id' => 'required|exists:themes,id',
            'date' => 'required|date',
        ]);

        return ContentDetail::create($request->all());
    }

    //Función para la actualización de un detalle de contenido
    public function update(Request $request, ContentDetail $content)
    {
        //Comprobación de permisos
        $this->authorize('update', $content);

        //Validación de los campos para actializar un detalle de contenido
        $validatedData = $request->validate([
            'content_id' => 'exists:contents,id',
            'user_id' => 'exists:users,id',
            'theme_id' => 'exists:themes,id',
            'date' => 'date',
        ]);

        $content->update($request->all());
        return response()->json($content, 200);
    }

    //Función para la eliminación de un detalle de contenido
    public function delete(ContentDetail $content)
    {
        //Comprobación de permisos
        $this->authorize('delete', $content);

        $content->delete();
        return response()->json(null, 204);
    }
}
