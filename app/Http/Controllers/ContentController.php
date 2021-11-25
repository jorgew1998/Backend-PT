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
    public function show($id)
    {
        return Content::find($id);
    }
    public function store(Request $request)
    {
        return Content::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $article = Content::findOrFail($id);
        $article->update($request->all());
        return $article;
    }
    public function delete(Request $request, $id)
    {
        $article = Content::findOrFail($id);
        $article->delete();
        return 204;
    }
}
