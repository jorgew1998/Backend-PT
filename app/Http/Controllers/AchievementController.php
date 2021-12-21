<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Achievement::class);
      //  $achievementsList = Achievement::all();
       // $achievements = [];

       // foreach ($achievementsList as $achievement) {
        //    if($achievement->user_id === auth()->user()->id){
         //       $achievements[] = $achievement;
         //   }
      //  }
        return Achievement::all();
      //  return response()-> json($achievements, 200);
    }
    public function show(Achievement $achievement)
    {
        $this->authorize('view', $achievement);
        return $achievement;
    }
    public function store(Request $request)
    {
        $this->authorize('create', Achievement::class);

        $validatedData = $request->validate([
            'title' => 'required|string|unique:achievements',
            'description' => 'required|string',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
        ]);

        $achievement = new Achievement($request->all());
        $path = $request->image->store('public/achievements');
        $achievement->image = $path;
        $achievement->save();
        //$achievement = Achievement::create($request->all());
        return response()->json($achievement, 201);
    }
    public function update(Request $request, Achievement $achievement)
    {
        $this->authorize('update', $achievement);
        $validatedData = $request->validate([
            'title' => 'string|unique:achievements',
            'description' => 'string',
            'image' => 'image|dimensions:min_width=200,min_height=200',
        ]);

        $achievement->update($request->all());
        return response()->json($achievement, 200);
    }
    public function delete(Achievement $achievement)
    {
        $this->authorize('delete', $achievement);
        $achievement->delete();
        return response()->json(null, 204);
    }

    public function initialAchievements (Request $request) {

        $this->authorize('create', Achievement::class);

        $validatedData = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'image' => 'image|dimensions:min_width=200,min_height=200',
        ]);

        $achievements = $request["data"];

        foreach ($achievements as $key => $value) {

            $title = $achievements[$key]["title"];
            $description = $achievements[$key]["description"];
            $image = $achievements[$key]["image"];


            Achievement::create([
                'title' => $title,
                'description' => $description,
                'image' => $image,
            ]);
        }
        return response()->json($request,201);
    }
}
