<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserLessons;
use Illuminate\Http\Request;
use App\Models\{
    Lesson,
    Tag,
    User
};

class RelationshipController extends Controller
{
    public function userLessons($id)
    {
        $user = UserLessons::collection(User::find($id)->with('lessons')->get());
        return $user->response()->setStatusCode(200);
        // return User::find($id)->with('lessons')->get();
    }

    public function lessonTags($id)
    {
        $lesson = Lesson::find($id)->tags;
        return $lesson;
    }

    public function tagLessons($id)
    {
        $tag = Tag::find($id)->lessons;
        return $tag;
    }
}
