<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        return Theme::all();
    }
    public function show($id)
    {
        return Theme::find($id);
    }
    public function store(Request $request)
    {
        return Theme::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $article = Theme::findOrFail($id);
        $article->update($request->all());
        return $article;
    }
    public function delete(Request $request, $id)
    {
        $article = Theme::findOrFail($id);
        $article->delete();
        return 204;
    }
}
