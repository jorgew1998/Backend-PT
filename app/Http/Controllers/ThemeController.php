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

        $validatedData = $request->validate([
            'title' => 'required|string|unique:themes',
            'difficulty' => 'required|string',
            'advance' => 'required|string',
        ]);


        $theme = Theme::create($request->all());
        return response()->json($theme, 201);
    }
    public function update(Request $request, Theme $theme)
    {

        $validatedData = $request->validate([
            'title' => 'string|unique:themes',
            'difficulty' => 'string',
            'advance' => 'string',
        ]);


        $theme->update($request->all());
        return response()->json($theme, 200);
    }
    public function delete(Theme $theme)
    {
        $theme->delete();
        return response()->json(null, 204);
    }
}
