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
    public function show(Theme $theme)
    {
        return $theme;
    }
    public function store(Request $request)
    {
        $theme = Theme::create($request->all());
        return response()->json($theme, 201);
    }
    public function update(Request $request, Theme $theme)
    {
        $theme->update($request->all());
        return response()->json($theme, 200);
    }
    public function delete(Theme $theme)
    {
        $theme->delete();
        return response()->json(null, 204);
    }
}
