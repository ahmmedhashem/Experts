<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index(){

        $users = User::orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(UserRequest $request) {
        try {
            $request -> merge(['password' => bcrypt($request -> password)]);
            $user = User::create([
                'name' => $request -> name,
                'email' => $request -> email,
                'password' => $request -> password,
            ]);

            return redirect()->route('admin.users')->with(['success' => __('تم اضافه المستخدم بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function edit($id) {
        $user = User::find($id);
        if(!$user){
            return redirect()->route('admin.users')->with(['error' => __('هذا المعيار غير موجود')]);
        }else{
            return view('admin.users.edit', compact('user'));
        }
    }

    public function update(UserRequest $request, $id) {
        try {
            if($request -> filled('password')){
                $request -> merge(['password' => bcrypt($request -> password)]);
            }else{
                unset($request['password']);
            }

            $user = User::find($id);
            if(!$user)
                return redirect()->route('admin.users')->with(['error' => __('هذا المستخدم غير موجود')]);

            $user->update($request->except('_token', 'id','password_confirmation'));

            return redirect()->route('admin.users')->with(['success' => __('تم تحديث المستخدم الرئسي بنجاح')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => __('هناك خطأ ما')]);
        }
    }

    public function delete($id) {
        try {
            $user = User::find($id);
            if(!$user)
                return redirect()->route('admin.users')->with(['error' => __('هذا المستخدم غير موجود')]);

            $user->delete();
            return redirect()->route('admin.users')->with(['success' => __('تم حذف المستخدم بنجاح')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => __('هناك خطأ ما')]);
        }

    }
}
