<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\MyCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyCourseController extends Controller
{
    public function index(Request $request)
    {
        $mycourse = MyCourse::query();
        $user_id = $request->query('user_id');
        $mycourse->when($user_id, function ($query) use ($user_id) {
            return $query->where('user_id', '=', $user_id);
        });

        $mycourse->with('course');

        return successResponse(200, $mycourse->get());
    }

    public function store(Request $request)
    {
        $rules = [
            "course_id" => "required|integer",
            "user_id" => "required|integer"
        ];

        $validated = Validator::make($request->all(), $rules);

        if ($validated->fails()) {
            return errResponse(400, $validated->errors());
        }

        $course = Course::find($request['course_id']);
        if (!$course) {
            return errResponse(404, 'course not found');
        }

        $user = getUser($request['user_id']);
        if ($user['status'] === 'error') {
            return errResponse($user['status_code'], $user['message']);
        }

        $isExist = MyCourse::where('course_id', '=', $request['course_id'])->where('user_id', '=', $request['user_id'])->exists();
        if ($isExist) {
            return errResponse(409, 'user already taken this course');
        }

        $mycourse = MyCourse::create($request->all());

        return successResponse(200, $mycourse);
    }
}
