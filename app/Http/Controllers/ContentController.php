<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Theme;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Content::class);
        return Content::all();
    }
    public function show(Content $content)
    {
        $this->authorize('view', $content);
        return $content;
    }
    public function store(Request $request)
    {
        $this->authorize('create', Content::class);
        $validatedData = $request->validate([
            'description' => 'required|string',
            'question' => 'required|string',
            'answer_1' => 'required|string',
            'answer_2' => 'required|string',
            'answer_3' => 'required|string',
            'answer_4' => 'required|string',
            'feedback' => 'required|string',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
            'theme_id'=> 'required|exists:themes,id',
        ]);

        $content = new Content($request->all());
        $path = $request->image->store('public/contents');
        $content->image = $path;
        $content->save();
        //$content = Content::create($request->all());
        return response()->json($content, 201);
    }
    public function update(Request $request, Content $content)
    {
        $this->authorize('update', $content);
        $validatedData = $request->validate([
            'description' => 'string',
            'question' => 'string',
            'answer_1' => 'string',
            'answer_2' => 'string',
            'answer_3' => 'string',
            'answer_4' => 'string',
            'feedback' => 'string',
            'image' => 'image|dimensions:min_width=200,min_height=200',
            'theme_id'=> 'exists:themes,id',
        ]);

        $content->update($request->all());
        return response()->json($content, 200);
    }

    public function contents(Theme $theme) {
        return response()->json($theme->contents, 201);
    }

    public function delete(Content $content)
    {
        $this->authorize('delete', $content);
        $content->delete();
        return response()->json(null, 204);
    }

    public function initialContents(Request $request) {

        $this->authorize('create', Content::class);
        $validatedData = $request->validate([
            'description' => 'string',
            'question' => 'string',
            'answer_1' => 'string',
            'answer_2' => 'string',
            'answer_3' => 'string',
            'answer_4' => 'string',
            'feedback' => 'string',
            'image' => 'image|dimensions:min_width=200,min_height=200',
            'theme_id'=> 'exists:themes,id',
        ]);

        $contents = $request['data'];

        foreach ($contents  as $key => $value) {

            $description = $contents[$key]["description"];
            $question = $contents[$key]["question"];
            $answer1= $contents[$key]["answer_1"];
            $answer2= $contents[$key]["answer_2"];
            $answer3= $contents[$key]["answer_3"];
            $answer4= $contents[$key]["answer_4"];
            $feedback= $contents[$key]["feedback"];
            $themeID= $contents[$key]["theme_id"];
            $image= $contents[$key]["feedback"];

            Content::create([
                'description' => $description,
                'question' => $question,
                'answer_1' => $answer1,
                'answer_2' => $answer2,
                'answer_3' => $answer3,
                'answer_4' => $answer4,
                'feedback' => $feedback,
                'theme_id' => $themeID,
                'image' => $image,
            ]);
        }
        return response()->json($request,201);
    }
}
