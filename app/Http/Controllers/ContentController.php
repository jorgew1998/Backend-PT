<?php

namespace App\Http\Controllers;

use App\Models\Content;
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
        $content = Content::create($request->all());
        return response()->json($content, 201);
    }
    public function update(Request $request, Content $content)
    {
        $content->update($request->all());
        return response()->json($content, 200);
    }
    public function delete(Content $content)
    {
        $content->delete();
        return response()->json(null, 204);
    }
}
