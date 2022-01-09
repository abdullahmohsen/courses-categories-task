<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $courses = Course::with('category')->paginate(10);
        $categories = Category::get();
        return view('home', compact('courses', 'categories'));
    }

    public function searchCourses(Request $request) {
        $courses = Course::where('name', 'like', '%' . $request->get('searchQuest') . '%')->get();
        return json_encode($courses);
    }
}
