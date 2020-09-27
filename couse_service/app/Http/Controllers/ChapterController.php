<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            "course_id" => "required|integer",
            "name" => "required|string",
        ];

        $validated = Validator::make($request->all(), $rules);

        if ($validated->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validated->errors()
            ], 400);
        }

        $course = Course::find($request['course_id']);
        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'course not found'
            ], 404);
        }

        $data = Chapter::create($request->all());

        return response()->json([
            'status' => 'success',
            "data" => $data
        ]);
    }


    public function update(Request $request, Chapter $chapter)
    {
        $rules = [
            "course_id" => "integer",
            "name" => "string",
        ];

        $validated = Validator::make($request->all(), $rules);

        if ($validated->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validated->errors()
            ], 400);
        }

        if (isset($request['course_id'])) {
            $course = Course::find($request['course_id']);
            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'course not found'
                ], 404);
            }
        }

        $chapter->fill($request->all());
        $chapter->save();

        return response()->json([
            "status" => "success",
            "data" => $chapter
        ]);
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfull deleted data',
        ], 201);
    }
}
