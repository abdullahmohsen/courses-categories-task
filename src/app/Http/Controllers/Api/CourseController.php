<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use ApiResponseTrait;
    protected $course;
    protected $category;
    public function __construct(Course $course, Category $category)
    {
        $this->course = $course;
        $this->category = $category;
    }

    public function index()
    {
        $courses = $this->course->get();
        return $this->apiResponse(200, 'All Categories', NULL, $courses);
    }

    public function store(CourseRequest $request)
    {
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
        return $this->apiResponse(200,'Course created successfully');
    }

    public function update(Request $request) {
        $validation = Validator::make(request()->all(), [
            'course_id'   => 'required|exists:courses,id',
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required',
            'views'       => 'required|integer',
            'level'       => 'required|in:beginner,immediate,high',
            'hours'       => 'required',
            'rating'      => 'required'
        ]);
        if ($validation->fails()) {
            return $this->apiResponse(400, 'Validation Errors', $validation->errors());
        }
        $course = $this->course->find(request()->course_id);
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
        return $this->apiResponse(200,'Course updated successfully');
    }

    public function destroy()
    {
        $validation = Validator::make(request()->all(), ['course_id' => 'required|exists:courses,id']);
        if ($validation->fails()) {
            return $this->apiResponse(400, 'Validation Errors', $validation->errors());
        }
        $course = $this->course->find(request()->course_id);
        if (is_null($course)) {
            return $this->ApiResponse(400, 'Course already deleted');
        }
        $course->delete();
        return $this->ApiResponse(200, 'Course deleted successfully');
    }
}
