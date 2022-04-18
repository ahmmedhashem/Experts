<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activitie;
use App\Models\Main_criteria;
use App\Http\Requests\Admin\ActivitiesRequest;
use DB;
use Illuminate\Support\Str;

class ActivitiesController extends Controller
{
    public function index(){

        $activities = Activitie::with('criteria') -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.activities.index', compact('activities'));
    }

    public function create() {
        $main_criteria = Main_criteria::orderBy('id','DESC') -> get();
        return view('admin.activities.create',compact('main_criteria'));
    }

    public function store(ActivitiesRequest $request) {
        try {

            if (!$request->has('is_active')){
                $request->request->add(['is_active' => 0]);
            }
            else{
                $request->request->add(['is_active' => 1]);
            }

            $activity = Activitie::create([
                'criteria_id' => $request -> criteria_id,
                'name' => $request -> name,
                'is_active' => $request -> is_active,
            ]);

            return redirect()->route('admin.activities')->with(['success' => __('تم اضافه النشاط بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.activities')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function edit($id) {
        $data = [];
        $data['activity'] = Activitie::find($id);
        $data['main_criteria'] = Main_criteria::orderBy('id','DESC') -> get();
        if(!$data['activity']){
            return redirect()->route('admin.activities')->with(['error' => __('هذا النشاط غير موجود')]);
        }else{
            return view('admin.activities.edit', $data);
        }
    }

    public function update(ActivitiesRequest $request, $id) {
        try {
            $activity = Activitie::find($id);
            if(!$activity)
                return redirect()->route('admin.activities')->with(['error' => __('هذا النشاط غير موجود')]);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $activity->update($request->except('_token', 'id'));

            return redirect()->route('admin.activities')->with(['success' => __('تم تحديث النشاط بنجاح')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.activities')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function delete($id) {
        try {
            $activity = Activitie::find($id);
            if(!$activity)
                return redirect()->route('admin.activities')->with(['error' => __('هذا النشاط غير موجود')]);

            $activity->delete();
            return redirect()->route('admin.activities')->with(['success' => __('تم حذف النشاط بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.activities')->with(['error' => __('هناك خطأ ما')]);
        }

    }
}
