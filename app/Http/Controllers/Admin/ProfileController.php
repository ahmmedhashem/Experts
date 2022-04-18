<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function edit() {
        $admin = Admin::find(auth('admin') -> user() -> id);
        return view('admin.profile.edit',compact('admin'));
    }

    public function update(ProfileRequest $request){
        try {
            $admin = Admin::find(auth('admin') -> user() -> id);
            if($request -> filled('password')){
                $request -> merge(['password' => bcrypt($request -> password)]);
            }else{
                unset($request['password']);
            }
            unset($request['password_confirmation']);
            unset($request['id']);
            $admin -> update($request -> all());
            return redirect()->back()->with(['success' => __('admin/profile.updated successfully')]);
        } catch (\Exception $ex) {
            // return $ex;
            return redirect()->back()->with(['error' => __('admin/profile.something went wrong')]);
        }
    }
}
