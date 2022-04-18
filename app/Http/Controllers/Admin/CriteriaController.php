<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main_criteria;
use App\Http\Requests\Admin\MainCriteriaRequest;
use DB;
use Illuminate\Support\Str;

class CriteriaController extends Controller
{
    public function index(){

        $main_criteria = Main_criteria::orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.main_criteria.index', compact('main_criteria'));
    }

    public function create() {
        return view('admin.main_criteria.create');
    }

    public function store(MainCriteriaRequest $request) {
        try {

            if (!$request->has('is_active')){
                $request->request->add(['is_active' => 0]);
            }
            else{
                $request->request->add(['is_active' => 1]);
            }

            $main_criteria = Main_criteria::create([
                'name' => $request -> name,
                'is_active' => $request -> is_active,
            ]);

            return redirect()->route('admin.criteria')->with(['success' => __('تم اضافه المعيار الرئسي بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.criteria')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function edit($id) {
        $main_criteria = Main_criteria::find($id);
        if(!$main_criteria){
            return redirect()->route('admin.criteria')->with(['error' => __('هذا المعيار غير موجود')]);
        }else{
            return view('admin.main_criteria.edit', compact('main_criteria'));
        }
    }

    public function update(MainCriteriaRequest $request, $id) {
        try {
            $main_criteria = Main_criteria::find($id);
            if(!$main_criteria)
                return redirect()->route('admin.criteria')->with(['error' => __('هذا المعيار غير موجود')]);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $main_criteria->update($request->except('_token', 'id'));

            return redirect()->route('admin.criteria')->with(['success' => __('تم تحديث المعيار الرئسي بنجاح')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.criteria')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function delete($id) {
        try {
            $main_criteria = Main_criteria::find($id);
            if(!$main_criteria)
                return redirect()->route('admin.criteria')->with(['error' => __('هذا المعيار غير موجود')]);

            $main_criteria->delete();
            return redirect()->route('admin.criteria')->with(['success' => __('تم حذف المعيار بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.criteria')->with(['error' => __('هناك خطأ ما')]);
        }

    }
}
