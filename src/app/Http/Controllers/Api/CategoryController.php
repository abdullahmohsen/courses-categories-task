<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->get();
        return $this->apiResponse(200, 'All Categories', NULL, $categories);
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        $this->category->create([
            'name'   => $input['name'],
            'active' => isset($input['active']) ?? false,
        ]);
        return $this->apiResponse(200,'Category created successfully');
    }


    public function update(Request $request)
    {
        $validation = Validator::make(request()->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:categories,name,'.$request->category_id,
        ]);
        if ($validation->fails()) {
            return $this->apiResponse(400, 'Validation Errors', $validation->errors());
        }
        $category = $this->category->find(request()->category_id);
        $input = $request->all();
        $category->update([
            'name'   => $input['name'],
            'active' => isset($input['active']) ?? false,
        ]);
        return $this->apiResponse(200,'Category updated successfully');
    }

    public function destroy()
    {
        $validation = Validator::make(request()->all(), ['category_id' => 'required|exists:categories,id']);
        if ($validation->fails()) {
            return $this->apiResponse(400, 'Validation Errors', $validation->errors());
        }
        $category = $this->category->find(request()->category_id);
        if (is_null($category)) {
            return $this->ApiResponse(400, 'Category already deleted');
        }
        $category->delete();
        return $this->ApiResponse(200, 'Category deleted successfully');
    }
}
