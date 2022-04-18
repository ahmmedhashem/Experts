<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Main_criteria;
use App\Models\Activitie;
use App\Models\Role;
use App\Models\Mission;
use App\Http\Requests\Admin\DataRequest;
use DB;
use Illuminate\Support\Str;

class DataController extends Controller
{
    public function index(){

        $datas = Data::with(['activity' => function($act) {
            $act -> with('criteria');
        },'mission' => function($mis) {
            $mis -> with('rule');
        }]) -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);

        return view('admin.data.index', compact('datas'));
    }

    public function create() {
        $data = [];
        $data['main_criteria'] = Main_criteria::orderBy('id','DESC') -> get();
        $data['rules'] = Role::orderBy('id','DESC') -> get();
        return view('admin.data.create', $data);
    }

    public function store(DataRequest $request) {
        try {
            if (!$request->has('is_active')){
                $request->request->add(['is_active' => 0]);
            }
            else{
                $request->request->add(['is_active' => 1]);
            }

            $data = Data::create([
                'activity_id' => $request -> activity_id,
                'mission_id' => $request -> mission_id,
                'rule_id' => $request -> rule_id,
                'name' => $request -> name,
                'is_active' => $request -> is_active,
            ]);

            return redirect()->route('admin.data')->with(['success' => __('تم اضافه البيانات بنجاح')]);
        } catch (\Exception $ex) {

            return redirect()->route('admin.data')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function edit($id) {
        $data = [];
        $data['main_criteria'] = Main_criteria::orderBy('id','DESC') -> get();
        $data['rules'] = Role::orderBy('id','DESC') -> get();
        $data['activities'] = Activitie::orderBy('id','DESC') -> get();
        $data['missions'] = Mission::orderBy('id','DESC') -> get();
        $data['data'] = Data::with(['activity' => function($act) {
            $act -> with('criteria');
        },'mission' => function($mis) {
            $mis -> with('rule');
        }]) -> find($id);

        if(!$data['data']){
            return redirect()->route('admin.data')->with(['error' => __('هذه البيانات غير موجوده')]);
        }else{
            return view('admin.data.edit', $data);
        }
    }

    public function update(DataRequest $request, $id) {
        try {

            $data = Data::find($id);
            if(!$data)
                return redirect()->route('admin.data')->with(['error' => __('هذه البيانات غير موجوده')]);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

                $data->update($request->except('_token', 'id'));

            return redirect()->route('admin.data')->with(['success' => __('تم تحديث البيانات بنجاح')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.data')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function delete($id) {
        try {
            $data = Data::find($id);
            if(!$data)
                return redirect()->route('admin.data')->with(['error' => __('هذه البيانات غير موجوده')]);

            $data->delete();
            return redirect()->route('admin.data')->with(['success' => __('تم حذف البيانات بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.data')->with(['error' => __('هناك خطأ ما')]);
        }

    }

    public function getActivitiesByCriteria(Request $request) {
        $data['activities'] = Activitie::where("criteria_id",$request->criteria_id)->get();
        return response()->json($data);
    }

    public function getMissionsByRules(Request $request) {
        $data['missions'] = Mission::where("role_id",$request->rule_id)->get();
        return response()->json($data);
    }



}
