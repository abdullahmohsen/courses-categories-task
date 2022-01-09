<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function index() {
        $categories = $this->category->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create() {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request) {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $this->category->create([
                'name'   => $input['name'],
                'active' => isset($input['active']) ?? false,
            ]);
            DB::commit();
            return redirect()->route('categories.index')->with('success', __('Category created successfully'));
        } catch (\Exception $ex) {
            DB::rollBack();
//            dd($ex->getMessage());
            return redirect()-back()->with('warning', __('Try again'));
        }
    }

    public function edit($id) {
        $category = $this->category->findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id) {
        try {
            DB::beginTransaction();
            $category = $this->category->findOrFail($id);
            $input = $request->all();
            $category->update([
                'name'   => $input['name'],
                'active' => isset($input['active']) ?? false,
            ]);
            DB::commit();
            return redirect()->route('categories.index')->with('success', __('Category updated successfully'));
        } catch (\Exception $ex) {
            DB::rollBack();
//            dd($ex->getMessage());
            return redirect()-back()->with('warning', __('Try again'));
        }
    }

    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
