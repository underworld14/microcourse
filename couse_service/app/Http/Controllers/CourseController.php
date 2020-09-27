<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::query();

        return response()->json([
            'status' => 'success',
            'data' => $courses->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            "name" => "string|required",
            "certificate" => "boolean",
            "thumbail" => "string",
            "type" => "required|in:free,premium",
            "status" => "required|in:draft,published",
            "price" => "integer",
            "level" => "required|in:all-level,beginner,intermediate,advance",
            "mentor_id" => "required|integer",
            "description" => "string"
        ];
        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()
            ], 400);
        }

        $mentor = Mentor::find($request['mentor_id']);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'mentor not found !'
            ], 404);
        }

        $course = Course::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $course
        ], 201);
    }

    public function show(Course $course)
    {
        $course->load('mentor', 'images');

        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $rules = [
            "name" => "string",
            "certificate" => "boolean",
            "thumbail" => "string",
            "type" => "in:free,premium",
            "status" => "in:draft,published",
            "price" => "integer",
            "level" => "in:all-level,beginner,intermediate,advance",
            "mentor_id" => "integer",
            "description" => "string"
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()
            ]);
        }

        if (isset($request['mentor_id'])) {
            $mentor = Mentor::find($request['mentor_id']);

            if (!$mentor) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'mentor not found !'
                ], 404);
            }
        }

        $course->fill($request->all());
        $course->save();

        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }


    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfull deleted data',
        ], 201);
    }
}
