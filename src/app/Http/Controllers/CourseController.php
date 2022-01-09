<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    protected $course;
    protected $category;
    public function __construct(Course $course, Category $category) {
        $this->course = $course;
        $this->category = $category;
    }

    public function index() {
        $courses = $this->course->get();
        return view('dashboard.courses.index', compact('courses'));
    }

    public function create() {
        $categories = $this->category->get();
        return view('dashboard.courses.create', compact('categories'));
    }

    public function store(CourseRequest $request) {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $min = Null;
            if (isset(explode(':', $input['hours'])[1])) {
                $min = (int) explode(':', $input['hours'])[1];
            }
            $hour = (int) $input['hours'] * 60;
            $this->course->create([
                'name'          => $input['name'],
                'category_id'   => $input['category_id'],
                'description'   => $input['description'] ?? NULL,
                'rating'        => (float)$input['rating'] ?? 0,
                'views'         => $input['views'],
                'levels'        => $input['level'],
                'hours'         => $hour + $min,
                'active'        => isset($input['active']) ?? FALSE,
            ]);
            DB::commit();
            return redirect()->route('courses.index')->with('success', __('Course created successfully'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()-back()->with('warning', __('Try again'));
        }
    }

    public function edit($id) {
        $course = $this->course->findOrFail($id);
        $categories = $this->category->get();
        return view('dashboard.courses.edit', compact('course', 'categories'));
    }

    public function update(CourseRequest $request, $id) {
        try {
            DB::beginTransaction();
            $course = $this->course->findOrFail($id);
            $input = $request->all();
            if ($input['hours'] != $course->hours) {
                $min = Null;
                if (isset(explode(':', $input['hours'])[1])) {
                    $min = (int) explode(':', $input['hours'])[1];
                }
                $hour = (int) $input['hours'] * 60;
                $input['hours'] = $hour + $min;
            }
            $course->update([
                'name'          => $input['name'],
                'category_id'   => $input['category_id'],
                'description'   => $input['description'] ?? NULL,
                'rating'        => (float) $input['rating'],
                'views'         => $input['views'],
                'levels'        => $input['level'],
                'hours'         => $input['hours'],
                'active'        => isset($input['active']) ?? FALSE,
            ]);
            DB::commit();
            return redirect()->route('courses.index')->with('success', __('Course updated successfully'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()-back()->with('warning', __('Try again'));
        }
    }

    public function destroy($id)
    {
        $course = $this->course->findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
