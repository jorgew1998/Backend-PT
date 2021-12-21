<?php

namespace App\Http\Controllers;

use App\Models\AchievementDetail;
use App\Models\Theme;
use Illuminate\Http\Request;

class AchievementDetailController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', AchievementDetail::class);

        $detailList = AchievementDetail::all();
        $details = [];

        foreach ($detailList as $detail) {
        if($detail->user_id === auth()->user()->id){
            $details[] = $detail;
          }
        }
         return response()-> json($details, 200);
        //return AchievementDetail::all();
    }
    public function show(AchievementDetail $achievement)
    {
        $this->authorize('view', $achievement);
        return $achievement;
    }
    public function store(Request $request)
    {
         $this->authorize('create', AchievementDetail::class);

         $validatedData = $request->validate([
             'achievement_id' => 'required|exists:achievements,id',
             'user_id' => 'required|exists:users,id',
             'theme_id' => 'required|exists:themes,id',
             'content_id' => 'required|exists:contents,id',
          ]);


        return AchievementDetail::create($request->all());
    }
    public function update(Request $request, AchievementDetail $achievement)
    {
        $validatedData = $request->validate([
            'achievement_id' => 'exists:achievements,id',
            'user_id' => 'exists:users,id',
            'theme_id' => 'exists:themes,id',
            'content_id' => 'exists:contents,id',
        ]);

        $achievement->update($request->all());
        return response()->json($achievement, 200);
    }
    public function delete(AchievementDetail $achievement)
    {
        $this->authorize('delete', $achievement);
        $achievement->delete();
        return response()->json(null, 204);
    }
}
