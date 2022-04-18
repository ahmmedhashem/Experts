<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Role;
use App\Http\Requests\Admin\MissionsRequest;
use DB;
use Illuminate\Support\Str;

class MissionsController extends Controller
{
    public function index(){

        $missions = Mission::with('rule') -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.missions.index', compact('missions'));
    }

    public function create() {
        $rules = Role::orderBy('id','DESC') -> get();
        return view('admin.missions.create',compact('rules'));
    }

    public function store(MissionsRequest $request) {
        try {

            if (!$request->has('is_active')){
                $request->request->add(['is_active' => 0]);
            }
            else{
                $request->request->add(['is_active' => 1]);
            }

            $mission = Mission::create([
                'role_id' => $request -> rule_id,
                'name' => $request -> name,
                'is_active' => $request -> is_active,
            ]);

            return redirect()->route('admin.missions')->with(['success' => __('تم اضافه المهمه بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.missions')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function edit($id) {
        $data = [];
        $data['mission'] = Mission::find($id);
        $data['rules'] = Role::orderBy('id','DESC') -> get();
        if(!$data['mission']){
            return redirect()->route('admin.missions')->with(['error' => __('هذه المهمه غير موجوده')]);
        }else{
            return view('admin.missions.edit', $data);
        }
    }

    public function update(MissionsRequest $request, $id) {
        try {
            $mission = Mission::find($id);
            if(!$mission)
                return redirect()->route('admin.missions')->with(['error' => __('هذه المهمه غير موجوده')]);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $mission->update($request->except('_token', 'id'));

            return redirect()->route('admin.missions')->with(['success' => __('تم تحديث المهمه بنجاح')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.missions')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function delete($id) {
        try {
            $mission = Mission::find($id);
            if(!$mission)
                return redirect()->route('admin.missions')->with(['error' => __('هذه المهمه غير موجوده')]);

            $mission->delete();
            return redirect()->route('admin.missions')->with(['success' => __('تم حذف المهمه بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.missions')->with(['error' => __('هناك خطأ ما')]);
        }

    }
}
