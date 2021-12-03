<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {

        $themeList = Theme::all();
        $themes = [];

        foreach ($themeList as $theme) {
            if($theme->user_id === auth()->user()->id){
                $themes[] = $theme;
            }
        }
        return response()-> json($themes, 200);
        //return Theme::all();
    }
    public function show(Theme $theme)
    {
        $this->authorize('view', $theme);
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
