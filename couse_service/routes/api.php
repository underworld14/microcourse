<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseImageController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\ReviewController;

// mentors
Route::get('/mentor', [MentorController::class, 'index']);
Route::get('/mentor/{id}', [MentorController::class, 'show']);
Route::post('/mentor', [MentorController::class, 'create']);
Route::patch('/mentor/{id}', [MentorController::class, 'update']);
Route::delete('/mentor/{id}', [MentorController::class, 'destroy']);

// courses
Route::get('/course', [CourseController::class, 'index']);
Route::get('/course/{course}', [CourseController::class, 'show']);
Route::post('/course', [CourseController::class, 'store']);
Route::patch('/course/{course}', [CourseController::class, 'update']);
Route::delete('/course/{course}', [CourseController::class, 'destroy']);

// chapters
Route::post('/chapter', [ChapterController::class, 'store']);
Route::patch('/chapter/{chapter}', [ChapterController::class, 'update']);
Route::delete('/chapter/{chapter}', [ChapterController::class, 'destroy']);

// lessons
Route::post('/lesson', [LessonController::class, 'store']);
Route::patch('/lesson/{lesson}', [LessonController::class, 'update']);
Route::delete('/lesson/{lesson}', [LessonController::class, 'destroy']);

// courseImage
Route::post('/image', [CourseImageController::class, 'store']);
Route::patch('/image/{courseImage}', [CourseImageController::class, 'update']);
Route::delete('/image/{courseImage}', [CourseImageController::class, 'destroy']);

// review
Route::post('/review', [ReviewController::class, 'store']);
Route::patch('/review/{review}', [ReviewController::class, 'update']);
Route::delete('/review/{review}', [ReviewController::class, 'destroy']);

// my courses
Route::get('/mycourse', [MyCourseController::class, 'index']);
Route::post('/mycourse', [MyCourseController::class, 'store']);
