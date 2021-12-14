<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Http\Resources\Theme as ThemeResource;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Theme::class);

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
        $this->authorize('create', Theme::class);
        $validatedData = $request->validate([
            'title' => 'required|string',
            'difficulty' => 'required|string',
            'advance' => 'required|string',
        ]);


        $theme = Theme::create($request->all());
        return response()->json($theme, 201);
    }
    public function update(Request $request, Theme $theme)
    {
        $this->authorize('update', $theme);
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
        $this->authorize('delete', $theme);
        $theme->delete();
        return response()->json(null, 204);
    }

    public function initialThemes (Request $request) {

        $this->authorize('create', Theme::class);
        $validatedData = $request->validate([
            'title' => 'string',
            'difficulty' => 'string',
            'advance' => 'string',
        ]);


        //$List = json_decode($request, true);
        $themes = $request['data'];

        foreach ($themes  as $key => $value) {
            $title = $themes[$key]["title"];
            $difficulty = $themes[$key]["difficulty"];
            $advance = $themes[$key]["advance"];

           Theme::create([
                'title' => $title,
                'difficulty' => $difficulty,
                'advance' => $advance,
        ]);
        }
        return response()->json($request,201);

    }

    public function themesId() {

        $themeList = Theme::all();
        $themes = [];

        foreach ($themeList as $theme) {
            if($theme->user_id === auth()->user()->id){
                $themes[] = $theme;
            }
        }
        return response()->json(ThemeResource::collection($themes));
    }
}
