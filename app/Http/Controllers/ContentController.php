<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Theme;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Content::class);
        return Content::all();
    }
    public function show(Content $content)
    {
        $this->authorize('view', $content);
        return $content;
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'description' => 'required|string',
            'question' => 'required|string',
            'answer_1' => 'required|string',
            'answer_2' => 'required|string',
            'answer_3' => 'required|string',
            'answer_4' => 'required|string',
            'feedback' => 'required|string',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
            'theme_id'=> 'exists:themes,id',
        ]);

        $content = new Content($request->all());
        $path = $request->image->store('public/contents');
        $content->image = $path;
        $content->save();
        //$content = Content::create($request->all());
        return response()->json($content, 201);
    }
    public function update(Request $request, Content $content)
    {

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

    public function contents(Theme $theme) {
        return response()->json($theme->contents, 201);
    }

    public function delete(Content $content)
    {
        $content->delete();
        return response()->json(null, 204);
    }
}
