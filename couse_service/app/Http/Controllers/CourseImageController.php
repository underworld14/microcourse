<?php

namespace App\Http\Controllers;

use App\Models\CourseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseImageController extends Controller
{

    public function store(Request $request)
    {
        $rules = [
            "course_id" => "integer|required",
            "image" => "string|required"
        ];

        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validated->errors()
            ], 400);
        }

        $image = CourseImage::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $image
        ]);
    }



    public function update(Request $request, CourseImage $courseImage)
    {
        $rules = [
            "course_id" => "integer",
            "image" => "string"
        ];

        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validated->errors()
            ], 400);
        }

        $courseImage->fill($request->all());
        $courseImage->save();

        return response()->json([
            'status' => 'success',
            'data' => $courseImage
        ]);
    }

    public function destroy(CourseImage $courseImage)
    {
        $courseImage->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfull deleted data',
        ]);
    }
}
