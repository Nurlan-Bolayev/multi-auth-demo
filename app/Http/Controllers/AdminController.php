<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    public function loginAdmin(Request $request){
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        $data = ['email' => $request->email,'password' => $request->password];
        If(Auth::guard('admin')->attempt($data)){
            return redirect()->intended('admin');
        }
        return redirect()->back()->withInput($request->only(['email','password']));
    }
}
