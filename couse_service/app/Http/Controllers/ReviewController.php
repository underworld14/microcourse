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
            "rating" => "required|integer|min:1|max:5",
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

        $user = getUser($request['user_id']);
        if ($user['status'] === 'error') {
            return errResponse($user['status_code'], $user['message']);
        }

        $isExist = Review::where('course_id', '=', $request['course_id'])->where('user_id', '=', $request['user_id'])->exists();
        if ($isExist) {
            return errResponse(409, 'user already taken this course');
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

        $review->fill($request->only('rating', 'note'));
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
