<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CategoriesRequest;
use DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(){

        $categories = Category::with('_parents') -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {

        $categories = Category::select('id','parent_id','name')->get();

        return view('admin.categories.create',compact('categories'));
    }

    public function store(CategoriesRequest $request) {
        try {

            if (!$request->has('is_active')){
                $request->request->add(['is_active' => 0]);
            }
            else{
                $request->request->add(['is_active' => 1]);
            }

            if ($request-> type == 1){
                $request->request->add(['parent_id' => NULL]);
            }

            $category = Category::create([
                'parent_id' => $request -> parent_id,
                'name' => $request -> name,
                'is_active' => $request -> is_active,
            ]);

            return redirect()->route('admin.categories')->with(['success' => 'Category added successfully']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.categories')->with(['error' => 'Something went wrong']);
        }
    }

    public function edit($id) {
        $category = Category::with('_parents') -> find($id);
        $categories = Category::select('id','parent_id','name')->get();

        //  return $category;
        if(!$category){
            return redirect()->route('admin.categories')->with(['error' => 'This category not exist']);
        }else{
            return view('admin.categories.edit', compact('category','categories'));
        }
    }

    public function update(CategoriesRequest $request, $id) {

        try {
            $category = Category::find($id);
            if(!$category)
                return redirect()->route('admin.categories')->with(['error' => 'This category not exist']);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            if ($request-> type == 1){
                $request->request->add(['parent_id' => NULL]);
            }

            $category->update($request->except('_token', 'id','type'));

            return redirect()->route('admin.categories')->with(['success' => 'Category updated successfully']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.categories')->with(['error' => 'Something went wrong']);
        }
    }

    public function delete($id) {
        try {
            $category = Category::find($id);
            if(!$category)
                return redirect()->route('admin.categories')->with(['error' => 'This category not exist']);

            $category->delete();
            return redirect()->route('admin.categories')->with(['success' => 'Category deleted successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'Something went wrong']);
        }

    }
}
