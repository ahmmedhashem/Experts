<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\Admin\RulesRequest;
use DB;
use Illuminate\Support\Str;

class RulesControlller extends Controller
{
    public function index(){

        $rules = Role::orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.rules.index', compact('rules'));
    }

    public function create() {
        return view('admin.rules.create');
    }

    public function store(RulesRequest $request) {
        try {

            if (!$request->has('is_active')){
                $request->request->add(['is_active' => 0]);
            }
            else{
                $request->request->add(['is_active' => 1]);
            }

            $rules = Role::create([
                'name' => $request -> name,
                'is_active' => $request -> is_active,
            ]);

            return redirect()->route('admin.rules')->with(['success' => __('تم اضافه القاعده بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.rules')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function edit($id) {
        $rule = Role::find($id);
        if(!$rule){
            return redirect()->route('admin.rules')->with(['error' => __('هذه القاعده غير موجوده')]);
        }else{
            return view('admin.rules.edit', compact('rule'));
        }
    }

    public function update(RulesRequest $request, $id) {
        try {
            $rule = Role::find($id);
            if(!$rule)
                return redirect()->route('admin.rules')->with(['error' => __('هذه القاعده غير موجوده')]);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $rule->update($request->except('_token', 'id'));

            return redirect()->route('admin.rules')->with(['success' => __('تم تحديث القاعده بنجاح')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.rules')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function delete($id) {
        try {
            $rule = Role::find($id);
            if(!$rule)
                return redirect()->route('admin.rules')->with(['error' => __('هذه القاعده غير موجوده')]);

            $rule->delete();
            return redirect()->route('admin.rules')->with(['success' => __('تم حذف القاعده بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.rules')->with(['error' => __('هناك خطأ ما')]);
        }

    }
}
