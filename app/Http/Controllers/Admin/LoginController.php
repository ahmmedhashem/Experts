<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\loginRequest;

class LoginController extends Controller
{
    public function getLogin() {
        return view('admin.auth.login');
    }

    public function Login(loginRequest $request) {
         //check if admin select remeber me or not if select make it true
         $remember_me = $request->has('remember_me') ? true : false;
         if(auth()->guard('admin')->attempt(['email'=> $request->input('email'),'password'=> $request->input('password')],$remember_me)){
             return redirect()->route('admin.dashboard');
         }
         return redirect()->back()->with(['error'=> 'هناك خطأ ما']);
    }



    public function logout() {
        $guard = $this -> GetGaurd();
        $guard -> logout();
        return redirect()->route('admin.login');
    }

    private function GetGaurd() {
        return auth('admin');
    }
}
