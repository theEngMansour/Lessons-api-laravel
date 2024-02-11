<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lesson as LessonResources;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit') <= 50 ? $request->query('limit') : 15;
        $lessons = LessonResources::collection(Lesson::paginate($limit));
        return $lessons->response()->setStatusCode('200');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new LessonResources(Lesson::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body
        ]));
        $lesson->tags()->attach($request->tags);
        return $lesson->response()->setStatusCode('200');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lesson = new LessonResources(Lesson::find($id));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lesson = new LessonResources(Lesson::findOrFail($id));
        $lesson->update($request->all());
        return $lesson
            ->response()
            ->setStatusCode(200, "Lesson Updated Succefully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return 204;
    }
}
