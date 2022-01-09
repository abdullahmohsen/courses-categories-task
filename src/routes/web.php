<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/courses/search', [HomeController::class, 'searchCourses'])->name('courses.search');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.home');
    })->name('dashboard.home');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('create', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
        Route::get('{id}/show', [CourseController::class, 'show'])->name('courses.show');
        Route::get('create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('create', [CourseController::class, 'store'])->name('courses.store');
        Route::get('{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::post('{id}/edit', [CourseController::class, 'update'])->name('courses.update');
        Route::post('delete/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });
});