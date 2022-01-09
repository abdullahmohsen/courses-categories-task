<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('create', [CategoryController::class, 'store']);
        Route::post('edit', [CategoryController::class, 'update']);
        Route::post('delete', [CategoryController::class, 'destroy']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::post('create', [CourseController::class, 'store']);
        Route::post('edit', [CourseController::class, 'update']);
        Route::post('delete', [CourseController::class, 'destroy']);
    });
});