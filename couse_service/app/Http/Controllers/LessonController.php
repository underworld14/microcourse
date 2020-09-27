<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            "chapter_id" => "required|integer",
            "name" => "required|string",
            "video" => "required|string",
        ];

        $validated = Validator::make($request->all(), $rules);

        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validated->errors()
            ], 400);
        }

        $chapter = Chapter::find($request['chapter_id']);
        if (!$chapter) {
            return response()->json([
                'status' => 'error',
                'message' => 'chapter not found !'
            ]);
        }

        $lesson = Lesson::create($request->all());

        return response()->json([
            "status" => "success",
            "data" => $lesson
        ]);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $rules = [
            "chapter_id" => "integer",
            "name" => "string",
            "video" => "string",
        ];

        $validated = Validator::make($request->all(), $rules);

        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validated->errors()
            ], 400);
        }

        if (isset($request['chapter_id'])) {
            $chapter = Chapter::find($request['chapter_id']);
            if (!$chapter) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'chapter not found !'
                ]);
            }
        }

        $lesson->fill($request->all());
        $lesson->save();

        return response()->json([
            'status' => 'success',
            'data' => $lesson
        ]);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfull deleted data',
        ], 201);
    }
}
