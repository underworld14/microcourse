<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $rules = [
            "user_id" => "required|integer",
            "course_id" => "required|integer",
            "rating" => "required|integer",
            "note" => "string"
        ];

        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validated->errors()
            ], 400);
        }

        $course = Course::find($request['course_id']);
        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'course not found !'
            ], 404);
        }

        $review = Review::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $review
        ]);
    }


    public function update(Request $request, Review $review)
    {
        $rules = [
            "user_id" => "integer",
            "course_id" => "integer",
            "rating" => "integer",
            "note" => "string"
        ];

        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validated->errors()
            ], 400);
        }

        if (isset($request['course_id'])) {
            $course = Course::find($request['course_id']);
            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'course not found !'
                ], 404);
            }
        }

        $review->fill($request->all());
        $review->save();

        return response()->json([
            'status' => 'success',
            'data' => $review
        ]);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
