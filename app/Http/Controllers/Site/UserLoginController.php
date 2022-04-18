<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;

class UserLoginController extends Controller
{
    public function getLogin() {
        return view('site.auth.login');
    }

    public function Login(LoginRequest $request) {
         //check if admin select remeber me or not if select make it true
         $remember_me = $request->has('remember_me') ? true : false;
         if(auth()->guard('web')->attempt(['email'=> $request->input('email'),'password'=> $request->input('password')],$remember_me)){
             return redirect()->route('home');
         }
         return redirect()->back()->with(['error' =>'هناك خطأ ما']);
    }



    public function logout() {
        $guard = $this -> GetGaurd();
        $guard -> logout();
        return redirect()->route('login');
    }

    private function GetGaurd() {
        return auth('web');
    }
}
