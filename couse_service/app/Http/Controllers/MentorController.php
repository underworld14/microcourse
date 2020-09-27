<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    public function errorResponse($code, $message)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }

    public function index()
    {
        $data = Mentor::all();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Mentor::where('id', '=', $id)->with('courses')->get();
        if (!$data) {
            return $this->errorResponse(404, 'Mentor not found');
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'photo' => 'required|url',
            'profession' => 'required|string',
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorResponse(400, $validator->errors());
        }

        $mentor = Mentor::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $mentor,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'photo' => 'url',
            'profession' => 'string',
            'email' => 'email'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorResponse(400, $validator->errors());
        }

        $mentor = Mentor::find($id);

        if (!$mentor) {
            return $this->errorResponse(404, 'Mentor not found');
        }

        $mentor->fill($request->all());
        $mentor->save();

        return response()->json([
            'status' => 'success',
            'data' => $mentor
        ]);
    }

    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successfull deleted data',
            'data' => compact('id')
        ]);
    }
}
