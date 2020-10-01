<?php

use Illuminate\Support\Facades\Http;


function getUser($id)
{
  $BASE_URL = env('USER_SERVICE_URL') . "/user/$id";
  $response = Http::get($BASE_URL);

  $data = $response->json();
  $data['status_code'] = $response->getStatusCode();

  return $data;
}

function getUsers($ids = [])
{
  $BASE_URL = env('USER_SERVICE_URL') . "/user";

  if (count($ids) === 0) {
    return response()->json([
      'status' => 'success',
      'data' => []
    ]);
  }

  $response = Http::get($BASE_URL, [
    'id' => implode(",", $ids)
  ]);

  $data = $response->json();
  $data['status_code'] = $response->getStatusCode();

  return $data;
}

function errResponse($status_code, $message)
{
  return response()->json([
    'status' => 'error',
    'message' => $message
  ], $status_code);
}

function successResponse($status_code = 200, $data = [])
{
  return response()->json([
    'status' => 'success',
    'data' => $data
  ], $status_code);
}
