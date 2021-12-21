<?php

namespace App\Http\Controllers;

use App\Models\ContentDetail;
use Illuminate\Http\Request;

class ContentDetailController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ContentDetail::class);

        $detailList = ContentDetail::all();
        $details = [];

        foreach ($detailList as $detail) {
            if($detail->user_id === auth()->user()->id){
                $details[] = $detail;
            }
        }
        return response()-> json($details, 200);

      //  return ContentDetail::all();
    }
    public function show(ContentDetail $content)
    {
        $this->authorize('view', $content);
        return $content;
    }
    public function store(Request $request)
    {
         $this->authorize('create', ContentDetail::class);

        $validatedData = $request->validate([
            'content_id' => 'required|exists:contents,id',
            'user_id' => 'required|exists:users,id',
            'theme_id' => 'required|exists:themes,id',
            'date' => 'required|date',
        ]);

        return ContentDetail::create($request->all());
        // return response()->json($achievement, 201);
    }
    public function update(Request $request, ContentDetail $content)
    {
        $this->authorize('update', $content);
        $validatedData = $request->validate([
            'achievement_id' => 'required|exists:achievements,id',
            'user_id' => 'exists:users,id',
            'theme_id' => 'exists:themes,id',
            'date' => 'date',
        ]);

        $content->update($request->all());
        return response()->json($content, 200);
    }
    public function delete(ContentDetail $content)
    {
        $this->authorize('delete', $content);
        $content->delete();
        return response()->json(null, 204);
    }
}
