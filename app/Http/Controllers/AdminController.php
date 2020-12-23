<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginFormRequest as RegisterFormRequest;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    public function loginAdmin(RegisterFormRequest $registerFormRequest){

        $data = ['email' => $registerFormRequest->email,'password' => $registerFormRequest->password];
        If(Auth::guard('admin')->attempt($data)){
            return redirect()->intended('admin');
        }
        return redirect()->back()->withInput($registerFormRequest->only(['email','password']));
    }
}
