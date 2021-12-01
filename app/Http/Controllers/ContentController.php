<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Theme;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        return Content::all();
    }
    public function show(Content $content)
    {
        return $content;
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'description' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);


        $content = Content::create($request->all());
        return response()->json($content, 201);
    }
    public function update(Request $request, Content $content)
    {

        $validatedData = $request->validate([
            'description' => 'string',
            'question' => 'string',
            'answer' => 'string',
        ]);

        $content->update($request->all());
        return response()->json($content, 200);
    }

    public function contents(Theme $theme) {
        return response()->json($theme->contents, 201);
    }

    public function delete(Content $content)
    {
        $content->delete();
        return response()->json(null, 204);
    }
}
