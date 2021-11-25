<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        return Achievement::all();
    }
    public function show($id)
    {
        return Achievement::find($id);
    }
    public function store(Request $request)
    {
        return Achievement::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $article = Achievement::findOrFail($id);
        $article->update($request->all());
        return $article;
    }
    public function delete(Request $request, $id)
    {
        $article = Achievement::findOrFail($id);
        $article->delete();
        return 204;
    }
}
