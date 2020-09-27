<?php

namespace App\Http\Controllers;

use App\Models\MyCourse;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function show($id)
    {
        $course = MyCourse::where('course_id', '=', $id);
    }
}
