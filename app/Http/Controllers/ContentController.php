<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Theme;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    //Función para la obtención de la lista de contenidos
    public function index()
    {
        return Content::all();
    }

    //Función para la obtención de un contenido en específico
    public function show(Content $content)
    {
        return $content;
    }

    //Función para la creación de un nuevo contenido
    public function store(Request $request)
    {
        //Comprobación de permisos
        $this->authorize('create', Content::class);

        //Validación de los campos para crear un contenido
        $validatedData = $request->validate([
            'description' => 'required|string',
            'question' => 'required|string',
            'answer_1' => 'required|string',
            'answer_2' => 'required|string',
            'answer_3' => 'required|string',
            'answer_4' => 'required|string',
            'feedback' => 'required|string',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
            'theme_id'=> 'required|exists:themes,id',
        ]);

        $content = new Content($request->all());
        $path = $request->image->store('public/contents');
        $content->image = $path;
        $content->save();
        return response()->json($content, 201);
    }

    //Función para la actualización de un contenido
    public function update(Request $request, Content $content)
    {
        //Comprobación de permisos
        $this->authorize('update', $content);

        //Validación de los campos para actualizar un contenido
        $validatedData = $request->validate([
            'description' => 'string',
            'question' => 'string',
            'answer_1' => 'string',
            'answer_2' => 'string',
            'answer_3' => 'string',
            'answer_4' => 'string',
            'feedback' => 'string',
            'image' => 'image|dimensions:min_width=200,min_height=200',
            'theme_id'=> 'exists:themes,id',
        ]);

        $content->update($request->all());
        return response()->json($content, 200);
    }

    //Función para la obtención de una lista de contenidos de un tema en específico
    public function contents(Theme $theme) {
        return response()->json($theme->contents, 201);
    }

    //Función para la eliminación de un contenido
    public function delete(Content $content)
    {
        //Comprobación de permisos
        $this->authorize('delete', $content);

        $content->delete();
        return response()->json(null, 204);
    }

}
